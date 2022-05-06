<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\ChildrenAttendence;
use App\Models\QrTransaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class checkStampingChildrenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *      exec: php artisan command:checkStampingChildren
     * @var string
     */
    protected $signature = 'command:checkStampingChildren {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checkStampingChildrenCommand';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = $this->argument("date");
        if (!empty($date)) {
            if (!preg_match('/\A[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}\z/', $date)) {
                return false;
            }
            $exp = explode('-', $date);
            if (!checkdate((int)$exp[1], (int)$exp[2], (int)$exp[0])) {
                return false;
            }
            $ymd = date("Ymd", strtotime($date));
        } else {
            $date = date('Y-m-d', strtotime('-1 day'));
            $ymd = date("Ymd", strtotime('-1 day'));
        }
        $this->info($date);
        $this->info($ymd);

        // 該当日クリア
        Notification::where('date', '=', $date)->delete();

        // 登園あり降園なし
        $check1 = ChildrenAttendence::where('date', '=', $date)
            ->join('children', 'children.id', '=', 'children_attendences.child_id')
            ->where('commuting_time', '<>', null)->where('leave_time', '=', null)
            ->select('children_attendences.*', 'children.name')->get();

        foreach ($check1 as $item) {
            Notification::create([
                'date' => $date,
                'child_id' => $item->child_id,
                'message' =>  $item->name . 'さんの打刻（降園）がありません。',
                'url' => '/child?date='.$date.'&',
            ]);
        }

        // 登園なし降園あり
        $check2 = ChildrenAttendence::where('date', '=', $date)
            ->join('children', 'children.id', '=', 'children_attendences.id')
            ->where('commuting_time', '=', null)->where('leave_time', '<>', null)
            ->select('children_attendences.*', 'children.name')->get();

        foreach ($check2 as $item) {
            Notification::create([
                'date' => $date,
                'child_id' => $item->child_id,
                'message' =>  $item->name . 'さんの打刻（登園）がありません。',
                'url' => '/child?date='.$date.'&',
            ]);
        }

        // 打刻3回以上
        $check3 = QrTransaction::where('ymd', '=', $ymd)
            ->join('children', 'children.qr', '=', 'qr_transactions.qr')
            ->groupBy('children.id', 'qr_transactions.ymd')
            ->having('count', '>', 2)
            ->select('qr_transactions.qr', 'children.id', 'children.name')
            ->selectRaw('COUNT(qr_transactions.qr) as count')
            ->get();

        foreach ($check3 as $item) {
            $qrTransaction = QrTransaction::where('ymd', '=', $ymd)->where('qr', $item->qr)->get();
            $string = [];
            foreach ($qrTransaction as $qr) {
                $string[] = Carbon::parse($qr->created_at)->format('H:i:s');
            }
            if (!empty($string) && COUNT($string) > 0) {
                $string = '('.implode(',', $string).')';
            }
            Notification::create([
                'date' => $date,
                'child_id' => $item->id,
                'message' =>  Carbon::parse($date)->format('y.m.d') . ' ' . $item->name . 'さんの打刻が'.$item->count.'回あります。' . $string,
                'url' => '/child?date='.$date.'&',
            ]);
        }

        return true;
    }
}