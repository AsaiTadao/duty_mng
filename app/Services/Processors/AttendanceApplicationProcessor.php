<?php

namespace App\Services\Processors;

use App\Models\Application;
use App\Models\ApplicationClass;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class AttendanceApplicationProcessor
{
    protected $error;

    public function process(Attendance &$attendance)
    {
        if (!$attendance->id) return;

        $applications = $attendance->applications()
                    ->where(['status' => Application::STATUS_APPROVED])
                    ->get();
        if ($applications->count() === 0) return;
        if(!$attendance->date) return;

        $date = $attendance->date->format('Y-m-d');

        $behindTimeApplications = $applications->where('application_class_id', ApplicationClass::TYPE_BEHIND_TIME);
        $leaveEarlyApplications = $applications->where('application_class_id', ApplicationClass::TYPE_LEAVE_EARLY);
        for ($i = 1; $i < 4; $i++)
        {
            $commuting_time_i = "commuting_time_$i";
            $shift_i = "shift$i";
            $behind_time_i = "behind_time_$i";

            $leave_time_i = "leave_time_$i";
            $leave_early_i = "leave_early_$i";


            if ($attendance->$behind_time_i > 0 && $attendance->$commuting_time_i && $behindTimeApplications->count())
            {
                if (!$attendance->$shift_i) {
                    $attendance->$behind_time_i = 0; // if shift is not defined, then behind time is pointless
                } else {
                    $shiftStart = Carbon::parse($date . ' ' . $attendance->$shift_i->start_time);

                    if ($shiftStart->gte($attendance->$commuting_time_i))
                    {
                        $attendance->$behind_time_i = 0;
                    } else {
                        $overlapped = 0;
                        foreach ($behindTimeApplications as $application)
                        {
                            if (!$application->time_before_correction || !$application->time_after_correction) continue;
                            $tmp = calcOverlappedPeriod(
                                $shiftStart,
                                $attendance->$commuting_time_i,
                                $application->time_before_correction,
                                $application->time_after_correction
                            );
                            if ($tmp > $overlapped)
                            {
                                $overlapped = $tmp;
                            }
                        }
                        if ($overlapped > 0)
                        {
                            $behindTime = $attendance->$behind_time_i - $overlapped;
                            $attendance->$behind_time_i = $behindTime > 0 ? $behindTime : 0;
                        }
                    }
                }
            }
            if ($attendance->$leave_early_i > 0 && $attendance->$leave_time_i && $leaveEarlyApplications->count())
            {
                if (!$attendance->$shift_i)
                {
                    $attendance->$leave_early_i = 0;
                } else {
                    $shiftEnd = Carbon::parse($date . ' ' . $attendance->$shift_i->end_time);
                    if ($shiftEnd->lte($attendance->$leave_time_i))
                    {
                        $attendance->$leave_early_i = 0;
                    } else {
                        $overlapped = 0;
                        foreach ($leaveEarlyApplications as $application)
                        {
                            if (!$application->time_before_correction || !$application->time_after_correction) continue;
                            $tmp = calcOverlappedPeriod(
                                $attendance->$leave_time_i,
                                $shiftEnd,
                                $application->time_before_correction,
                                $application->time_after_correction
                            );
                            if ($tmp > $overlapped)
                            {
                                $overlapped = $tmp;
                            }
                        }
                        if ($overlapped > 0)
                        {
                            $leaveEarly = $attendance->$leave_early_i - $overlapped;
                            $attendance->$leave_early_i = $leaveEarly > 0 ? $leaveEarly : 0;
                        }
                    }
                }
            }
        }
    }
}
