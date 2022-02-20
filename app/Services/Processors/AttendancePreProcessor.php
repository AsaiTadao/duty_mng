<?php

namespace App\Services\Processors;

use App\Models\Attendance;
use Illuminate\Support\Carbon;

/**
 * calculate behind time, leave early based on the commuting and leave time
 */
class AttendancePreProcessor
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
                    $minutes = Carbon::parse($attendance->$commute_time->format('Y-m-d') . ' ' . $attendance->$shift->start_time)
                        ->floatDiffInMinutes($attendance->$commute_time, false);
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
                    if ($attendance->$shift->start_time > $attendance->$shift->end_time)
                    {
                        [$y, $m, $d] = explode('-', $attendance->$leave_time->format('Y-m-d'));
                        $date = $y . '-' . $m . '-' . ($d + 1);
                    } else {
                        $date = $attendance->$leave_time->format('Y-m-d');
                    }
                    $minutes = $attendance->$leave_time
                        ->floatDiffInMinutes(
                            Carbon::parse($date . ' ' . $attendance->$shift->end_time),
                            false
                        );
                    if ($minutes > 0) {
                        $attendance->$leave_early = $minutes;
                    } else {
                        $attendance->$leave_early = 0;
                    }
                } else {
                    $attendance->$leave_early = 0;
                }
            } else {
                $attendance->$leave_early = 0;
            }
        }
    }
}
