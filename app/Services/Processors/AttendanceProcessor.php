<?php

namespace App\Services\Processors;

use App\Models\Attendance;

class AttendanceProcessor
{
    protected $error;

    public function process(Attendance &$attendance)
    {
        for ($i = 1; $i < 3; $i++) {

            $commute_time = "commuting_time_$i";
            $shift = "shift$i";
            $behind_time = "behind_time_$i";

            $leave_time = "leave_time_$i";
            $leave_early = "leave_early_$i";

            if ($attendance->$commute_time) {
                if ($attendance->$shift) {
                    // Carbon::now()->floatDiffInMinutes()
                    $minutes = $attendance->$commute_time->floatDiffInMinutes($attendance->$shift->start_time, false);

                    if ($minutes > 0) {
                        $attendance->$behind_time = $minutes;
                    } else {
                        $attendance->$behind_time = 0;
                    }
                } else {
                    $attendance->$behind_time = 0;
                }
            } else {
                $attendance->$behind_time = 0;
            }

            if ($attendance->$leave_time) {
                if ($attendance->$shift) {
                    $minutes = $attendance->$leave_time->floatDiffInMinutes($attendance->$shift->end_time, false);
                    if ($minutes < 0) {
                        $attendance->$leave_early = $minutes;
                    } else {
                        $attendance->$leave_early = 0;
                    }
                } else {
                    $attendance->$leave_early = 0;
                }
            }
        }
    }
}