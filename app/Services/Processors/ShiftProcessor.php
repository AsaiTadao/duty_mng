<?php

namespace App\Services\Processors;

use App\Constants\VacationReason;
use App\Models\ShiftPlan;
use App\Models\WorkingHour;
use Illuminate\Support\Carbon;

class ShiftProcessor
{
    protected $error;

    /**
     * @param $shifts: ShiftRequest valided data
     * @param User $user: target user
     * @param Carbon $date: target date
     */
    public function validated($shifts, $user, $date)
    {
        // prod: prevent edit past shift

        // if ($date->day <= Carbon::now()->day)
        // {
        //     $this->error = trans('Cannot edit past shift');
        //     return false;
        // }

        $shiftArr = [];

        foreach ($shifts['shifts'] as $shiftData) {
            $workingHoursId = null;
            $startTime = null;
            $endTime = null;
            $restStartTime = null;
            $restEndTime = null;
            $vacationReasonId = null;
            if ($shiftData['vacation_reason_id'] === VacationReason::WORK) {
                // check start time end time consistency
                $startTime = null;
                $endTime = null;
                if (!empty($shiftData['working_hours_id'])) {
                    $workingHour = WorkingHour::where([
                        'id' => $shiftData['working_hours_id'],
                        'enable' => true,
                        'employment_status_id' => $user->employment_status_id
                    ])->first();

                    if (!$workingHour) {
                        $this->error = trans('Working hour is not enabled');
                        return false;
                    }
                    $startTime = $workingHour->start_time;
                    $endTime = $workingHour->end_time;
                    $workingHoursId = $shiftData['working_hours_id'];
                } else {
                    if (empty($shiftData['start_time']) || empty($shiftData['end_time'])) {
                        $this->error = trans('Please input start time and end time');
                        return false;
                    }
                    $startTime = $shiftData['start_time'];
                    $endTime = $shiftData['end_time'];
                }
                if ($startTime >= $endTime) {
                    $this->error = trans("Start time is bigger than end time");
                    return false;
                }

                // check rest time consistency
                if (!empty($shiftData['rest_start_time']) || !empty($shiftData['rest_end_time'])) {
                    if (
                        (empty($shiftData['rest_start_time']) && !empty($shiftData['rest_end_time'])) ||
                        (!empty($shiftData['rest_start_time']) && empty($shiftData['rest_end_time']))
                    ) {
                        $this->error = trans("Please input valid rest time");
                        return false;
                    }
                    if ($shiftData['rest_start_time'] >= $shiftData['rest_end_time']) {
                        $this->error = trans("Rest start time is bigger than rest end time");
                        return false;
                    }
                    if (
                        $shiftData['rest_start_time'] < $startTime ||
                        $shiftData['rest_start_time'] > $endTime ||
                        $shiftData['rest_end_time'] < $startTime ||
                        $shiftData['rest_end_time'] > $endTime
                    ) {
                        $this->error = trans('Rest time is not in the work time period');
                        return false;
                    }
                    $restStartTime = $shiftData['rest_start_time'];
                    $restEndTime = $shiftData['rest_end_time'];
                }
            } else {
                $vacationReasonId = $shiftData['vacation_reason_id'];
            }

            if (!empty($shiftData['id'])) {
                $shift = ShiftPlan::where(['id' => $shiftData['id']])->whereDate('date', $date)->first();
                if ($shift->user_id !== $user->id) {
                    $this->error = trans('User does not match');
                    return false;
                }
            } else {
                $shift = new ShiftPlan();
            }

            $shift->fill([
                'day_of_week'   =>  $date->dayOfWeek,
                'date'          =>  $date->format('Y-m-d'),
                'user_id'       =>  $user->id,
                'working_hours_id' =>   $workingHoursId,
                'start_time'    =>  $startTime,
                'end_time'      =>  $endTime,
                'rest_start_time' => $restStartTime,
                'rest_end_time' =>  $restEndTime,
                'vacation_reason_id'    =>  $vacationReasonId,
            ]);
            if (!empty($vacationReasonId)) {
                return [$shift];
            }
            $shiftArr[] = $shift;
        }
        if (count($shiftArr) > 1) {
            for ($i = 0; $i < count($shiftArr); $i++) {
                $shift = $shiftArr[$i];
                for ($j = $i + 1; $j < count($shiftArr); $j++) {
                    $targetShift = $shiftArr[$j];
                    if (
                        ($shift->start_time >= $targetShift->start_time &&
                            $shift->startTime <= $targetShift->end_time
                        ) ||
                        ($shift->endTime >= $targetShift->start_time &&
                            $shift->endTime <= $targetShift->end_time
                        ) ||
                        ($shift->startTime <= $targetShift->start_time &&
                            $shift->endTime >= $targetShift->end_time
                        )
                    ) {
                        $this->error = trans("Work time is overlapped with other shifts");
                        return false;
                    }
                }
            }
        }
        return $shiftArr;
    }

    /**
     * @return boolean // true: success, false: failed
     */
    public function save($shifts, $user, $date)
    {
        if (is_array($shifts)) {
            $shifts = collect($shifts);
        }
        $needDeleteShiftQb = ShiftPlan::where(['user_id' => $user->id])
            ->whereDate('date', $date);
        if ($shifts->count()) {
            $ids = $shifts->whereNotNull('id')->pluck('id')->all();
            if (count($ids)) {
                $needDeleteShiftQb->whereNotIn('id', $ids);
            }
        }
        $needDeleteShiftQb->delete();
        foreach ($shifts as $shift) {
            $shift->save();
        }
        return true;
    }

    public function getError()
    {
        return $this->error;
    }
}
