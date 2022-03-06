<?php

namespace App\Console\Commands;

use App\Models\Child;
use App\Models\ChildrenAttendence;
use App\Models\QrTransaction;
use App\Models\Year;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class stampChildrenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *          exec: php artisan command:stampChildren
     * @var string
     */
    protected $signature = 'command:stampChildren {device_id} {office_id} {data} {datetime}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'stampChildrenCommand';

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
        $deviceId = $this->argument("device_id");
        $officeId = $this->argument("office_id");
        $data = $this->argument("data");
        $datetime = $this->argument("datetime");

        $date = date("Y-m-d", strtotime($datetime));
        $ymd = date("Ymd", strtotime($datetime));
        $ym = date("Ym", strtotime($datetime));
        $m = date("m", strtotime($datetime));
        $d = date("d", strtotime($datetime));

        $child = Child::where('qr', $data)->first();
        if (empty($child) || empty($child->id)) {
            return false;
        }

        $year = Year::where('start', '<=', $ym)->where('end', '>=', $ym)->first();
        if (empty($year) || empty($year->id)) {
            return false;
        }

        $count = ChildrenAttendence::where('child_id', $child->id)->where('year_id', $year->id)
            ->where('month', $m)->where('day', $d)->count();

        switch ($count) {
            case 0:
                ChildrenAttendence::create([
                    'child_id' => $child->id,
                    'year_id' => $year->id,
                    'month' => $m,
                    'day' => $d,
                    'date' => $date,
                    'commuting_time' => $datetime
                ]);
                break;
            case 1:
                ChildrenAttendence::where('child_id', $child->id)->where('year_id', $year->id)
                    ->where('month', $m)->where('day', $d)
                    ->update(['leave_time' => $datetime]);
                break;
            default:
                Log::info('ChildrenAttendence is stamped ['.($count + 1).'] times today.');
        }

        QrTransaction::create([
            'device_id' => $deviceId,
            'office_id' => $officeId,
            'qr' => $data,
            'ymd' => $ymd,
            'counter' => $count + 1,
        ]);

        return true;
    }
}
