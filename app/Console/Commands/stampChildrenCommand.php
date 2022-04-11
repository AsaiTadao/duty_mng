<?php

namespace App\Console\Commands;

use App\Models\Child;
use App\Models\ChildrenAttendence;
use App\Models\OfficeInformation;
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
    protected $signature = 'command:stampChildren {device_id} {data} {datetime}';

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
        //$officeId = $this->argument("office_id");
        $data = $this->argument("data");
        $datetime = $this->argument("datetime");

        $date = date("Y-m-d", strtotime($datetime));
        $ymd = date("Ymd", strtotime($datetime));
        $ym = date("Ym", strtotime($datetime));
        $m = date("m", strtotime($datetime));
        $d = date("d", strtotime($datetime));
        $time = date("His", strtotime($datetime));

        $child = Child::where('qr', $data)->first();
        if (empty($child) || empty($child->id)) {
            return false;
        }

        $year = Year::where('start', '<=', $ym)->where('end', '>=', $ym)->first();
        if (empty($year) || empty($year->id)) {
            return false;
        }

        $attendence = ChildrenAttendence::where('child_id', $child->id)->where('year_id', $year->id)
            ->where('month', $m)->where('day', $d)->first();

        if(!empty($attendence)){
            if(!empty($attendence->leave_time)){
                Log::info('ChildrenAttendence leave is stamped.');
                $count = 3;
            } else {
                    if(date('His',strtotime( $attendence->commuting_time . '+10 min')) < $time) {
                        $office = OfficeInformation::where('office_id', $child->office_id)->first();
                        $close_time = $office->close_time;
                        $extension = strtotime($time) - strtotime($date . $close_time);
                        //延長時間timezoneの問題で9時間ずれるので補正
                        $extension = $extension > 0 ? date("H:i:s",$extension - 9*60*60) : NULL;

                        ChildrenAttendence::where('child_id', $child->id)->where('year_id', $year->id)
                            ->where('month', $m)->where('day', $d)
                            ->update([
                                'leave_time' => $datetime,
                                'extension' => $extension
                            ]);

                        $count = 2;
                    } else {
                        Log::info('ChildrenAttendence commute is stamped.');
                        $count = 4;
                    }
            }
        } else {
                    ChildrenAttendence::create([
                    'child_id' => $child->id,
                    'year_id' => $year->id,
                    'month' => $m,
                    'day' => $d,
                    'date' => $date,
                    'commuting_time' => $datetime
                ]);
            $count = 1;
        }

        QrTransaction::create([
            'device_id' => $deviceId,
            'qr' => $data,
            'ymd' => $ymd,
            'counter' => $count,
        ]);

        return true;
    }
}
