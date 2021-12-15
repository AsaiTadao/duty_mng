<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\ShiftPlan;
use App\Models\User;
use App\Models\Year;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class StampService
{
    protected $error;

    private $logEnabled = true;

    public function setLogEnabled()
    {
        $this->logEnabled = true;
    }
    public function unsetLogEnabled()
    {
        $this->logEnabled = false;
    }

    /**
     * DO NOT SAVE attendance here
     * match shift and attendance of commute stamp with n'th ///// ONLY FOR COMMUTE STAMP
     * @param User $user
     * @param Carbon $stamp
     * @param string $type
     *
     * @return
     *  null: invalid stamp
     *
     * {
     *  attendance: matched attendance
     *  number: indicate nth shift of the attendance (1, 2)
     * }
     */
    public function commute($user,  Carbon $stamp)
    {
        $stampTime = $stamp->format('H:i:s');
        [$attendance, $shifts] = $this->getAttendanceShifts($user, $stamp);
        if (!$shifts->count()) {
            if (!$attendance->commuting_time_1 && !$attendance->leave_time_1) {
                $this->log($user, "getMatchedShift return 1 postion");
                $attendance->commuting_time_1 = $stamp;
                return [
                    'attendance' =>  $attendance,
                    'number'    =>  1
                ];
            }
            if (!$attendance->commuting_time_2 && !$attendance->leave_time_2) {
                $this->log($user, "getMatchedShift return 2 postion");
                $attendance->commuting_time_2 = $stamp;
                return [
                    'attendance'    =>  $attendance,
                    'number'        =>  2
                ];
            }
            $this->error = "Shift is empty at this time but stamp 3 or more times.";
            $this->log($user, "getMatchedShift return 4 postion");
            return null;
        }
        // boc: check if vaction
        $vacationShifts = $shifts->whereNotNull('vacation_reason_id');
        if ($vacationShifts->count()) {
            if (!$attendance->commuting_time_1 && !$attendance->leave_time_1) {
                $this->log($user, "getMatchedShift return 5 postion");
                $attendance->commuting_time_1 = $stamp;
                return [
                    'attendance' =>  $attendance,
                    'number'    =>  1
                ];
            }
            if (!$attendance->commuting_time_2 && !$attendance->leave_time_2) {
                $this->log($user, "getMatchedShift return 6 postion");
                $attendance->commuting_time_2 = $stamp;
                return [
                    'attendance'    =>  $attendance,
                    'number'        =>  2
                ];
            }
            $this->error = "Vacation day at this time but stamp 3 or more times.";
            $this->log($user, "getMatchedShift return 7 postion");
            return null;
        }
        // eoc: check if vaction

        // boc: check shifts
        $i = 0;
        foreach ($shifts as $shift) {
            $i++;
            if (!$shift->start_time || !$shift->end_time) {
                continue;
            }

            if ($i === 1) {
                if ($attendance->commuting_time_1 || $attendance->leave_time_1) {
                    continue;
                }
                if ($stampTime >= $shift->end_time) {
                    continue;
                }
                $attendance->shift1()->associate($shift);

                $this->log($user, "getMatchedShift return 8 postion");
                $attendance->commuting_time_1 = $stamp;
                return [
                    'attendance'    =>  $attendance,
                    'number'        =>  1,
                ];
            }
            if ($i === 2) {
                if ($attendance->commuting_time_2) {
                    continue;
                }
                if ($stampTime >= $shift->end_time) {
                    continue;
                }
                if ($stampTime <= $shifts[0]->end_time) {
                    $this->error = 'Stamp is before the first shift';
                    $this->log($user, "getMatchedShift return 9 postion");
                    return null;
                }
                $attendance->shift2()->associate($shift);
                $this->log($user, "getMatchedShift return 10 postion");
                $attendance->commuting_time_2 = $stamp;
                return [
                    'attendance' =>  $attendance,
                    'number'    =>  2,
                ];
            }
        }
        // eoc: check shifts list

        // boc: check beyond shifts
        if (!$attendance->commuting_time_1 && !$attendance->leave_time_1) {
            if (!empty($shifts[0])) {
                if ($stampTime < $shifts[0]->end_time) {
                    $attendance->shift1->associcate($shifts[0]);
                    $this->log($user, "getMatchedShift return 11 postion");
                    $attendance->commuting_time_1 = $stamp;
                    return [
                        'attendance'    =>  $attendance,
                        'number'        =>  1
                    ];
                }
            } else {
                $this->log($user, "getMatchedShift return 12 postion");
                $attendance->commuting_time_1 = $stamp;
                return [
                    'attendance'    =>  $attendance,
                    'number'        =>  1
                ];
            }
        } else if (!$attendance->commuting_time_2 && !$attendance->leave_time_2) {
            if (!empty($shifts[1])) {
                if ($stampTime > $shifts[0]->end_time) {
                    $attendance->shift1->associcate($shifts[1]);
                    $this->log($user, "getMatchedShift return 13 postion");
                    $attendance->commuting_time_2 = $stamp;
                    return [
                        'attendance'    =>  $attendance,
                        'number'        =>  2
                    ];
                }
            } else {
                if (!empty($shifts[0])) {
                    if ($stampTime > $shifts[0]->end_time ) {
                        $this->log($user, "getMatchedShift return 14 postion");
                        $attendance->commuting_time_2 = $stamp;
                        return [
                            'attendance'    =>  $attendance,
                            'number'        =>  2
                        ];
                    }
                } else {
                    $this->log($user, "getMatchedShift return 15 postion");
                    $attendance->commuting_time_2 = $stamp;
                    return [
                        'attendance'    =>  $attendance,
                        'number'        =>  2
                    ];
                }
            }
        }
        // eoc: check beyond shifts
        $this->error = "Invalid stamp request";
        $this->log($user, "getMatchedShift return 16 postion");
        return null;
    }

    /**
     * DO NOT SAVE attendance here
     * process $user's stamp data and fill attendance data
     * @return Attendance $attendance
     * null: error
     */
    public function leave(User $user, Carbon $stamp)
    {
        [$attendance, $shifts] = $this->getAttendanceShifts($user, $stamp);

        if ($attendance->leave_time_2) {
            $this->error = "Trying to leave stamp 3 or more times";
            $this->log($user, "leave : return position 1");
            return false;
        }
        if ($attendance->commuting_time_2 || $attendance->leave_time_1) {
            if ($attendance->commuting_time_2 && $stamp->lte($attendance->commuting_time_2)) {
                $this->error = "Invalid leave stamp request";
                $this->log($user, "leave : return position 2");
                return false;
            }
            $attendance->leave_time_2 = $stamp;
            return $attendance;
        }

        if ($shifts->count() === 0 || $shifts->count() === 1) {
            if ($attendance->commuting_time_1 && $stamp->lte($attendance->commuting_time_1)) {
                $this->error = "Invalid leave stamp request";
                $this->log($user, "leave : return position 3");
                return false;
            }
            $attendance->leave_time_1 = $stamp;
            return $attendance;
        }

        if ($stamp->format('H:i:s') > $shifts[1]->start_time) {
            $diffWithFirst = Carbon::parse($stamp->format('Y-m-d') . ' ' . $shifts[0]->end_time)->floatDiffInMinutes($stamp);
            $diffWitSecond = Carbon::parse($stamp->format('Y-m-d') . ' ' . $shifts[1]->end_time)->floatDiffInMinutes($stamp);
            if ($diffWitSecond < $diffWithFirst) {
                $attendance->leave_time_2 = $stamp;
                $this->log($user, "leave : return position 4");
                return $attendance;
            }
        }
        if ($attendance->commuting_time_1 && $stamp->lte($attendance->commuting_time_1)) {
            $this->error = "Invalid leave stamp request";
            $this->log($user, "leave : return position 5");
        }
        $attendance->leave_time_1 = $stamp;
        $this->log($user, "leave : return position 6");
        return $attendance;
    }

    public function getAttendanceShifts($user, Carbon $stamp)
    {
        $yearNumber = $stamp->year;
        $month = $stamp->month;
        $day = $stamp->day;

        $year = Year::where([
            ['start', '<=',  $yearNumber * 100 + $month],
            ['end', '>=', $yearNumber * 100 + $month]
        ])->first();

        $date = $stamp->format('Y-m-d');

        $attendance = Attendance::where([
            'year_id'   =>  $year->id,
            'month'     =>  $month,
            'day'       =>  $day,
            'user_id'   =>  $user->id
        ])->first();

        $shifts = ShiftPlan::where(['user_id' => $user->id])
            ->where(['date' => $date])
            ->orderBy('start_time')
            ->get();
        if (!$attendance) {
            $attendance = new Attendance([
                'year_id'   =>  $year->id,
                'month'     =>  $month,
                'day'       =>  $day,
                'day_of_week'=> $stamp->dayOfWeek
            ]);
            $attendance->user()->associate($user);
        }
        return [$attendance, $shifts];
    }

    public function matchShiftToAttendance(Attendance &$attendance)
    {
        $year_id = $attendance->year_id;
        $month = $attendance->month;
        $day = $attendance->day;
        $year = Year::where(['id' => $year_id])->first();

        $yearNumber = floor($year->start / 100);
        $monthNumber = $year->start % 100;

        if ($month < $monthNumber) {
            $yearNumber++;
        }
        $dateString = $yearNumber . '-' . sprintf('%02d', $month) . '-'. sprintf('%02d', $day);
        $date = Carbon::parse($dateString);
        $shifts = ShiftPlan::where(['user_id' => $attendance->user_id, 'date' => $date])->orderBy('start_time')->get();
        if ($shifts->count() === 0) return;

        if ($attendance->commuting_time_1 && $attendance->leave_time_1)
        {
            $overlapped = 0;
            $selectedIndex = -1;
            foreach($shifts as $i => $shift)
            {
                if ($overlapped < calcOverlappedPeriod(
                    $attendance->commuting_time_1,
                    $attendance->leave_time_1,
                    Carbon::parse($dateString . ' ' . $shift->start_time),
                    Carbon::parse($dateString . ' ' . $shift->end_time)
                )) {
                    $selectedIndex = $i;
                }
            }
            if ($selectedIndex >= 0) {
                $attendance->shift_1_id = $shifts[$selectedIndex]->id;
                unset($shifts[$selectedIndex]);
            }
        }
        if ($attendance->commuting_time_2 && $attendance->leave_time_2 && !empty($shifts[1]))
        {
            $overlapped = 0;
            $selectedIndex = -1;
            foreach($shifts as $i => $shift)
            {
                if ($overlapped < calcOverlappedPeriod(
                    $attendance->commuting_time_1,
                    $attendance->leave_time_1,
                    Carbon::parse($dateString . ' ' . $shift->start_time),
                    Carbon::parse($dateString . ' ' . $shift->end_time)
                )) {
                    $selectedIndex = $i;
                }
            }
            if ($selectedIndex >= 0) {
                $attendance->shift_1_id = $shifts[$selectedIndex]->id;
                unset($shifts[$selectedIndex]);
            }
        }
        if ($attendance->commuting_time_3 && $attendance->leave_time_3 && !empty($shifts[2]))
        {
            $overlapped = 0;
            $selectedIndex = -1;
            foreach($shifts as $i => $shift)
            {
                if ($overlapped < calcOverlappedPeriod(
                    $attendance->commuting_time_1,
                    $attendance->leave_time_1,
                    Carbon::parse($dateString . ' ' . $shift->start_time),
                    Carbon::parse($dateString . ' ' . $shift->end_time)
                )) {
                    $selectedIndex = $i;
                }
            }
            if ($selectedIndex >= 0) {
                $attendance->shift_1_id = $shifts[$selectedIndex]->id;
                unset($shifts[$selectedIndex]);
            }
        }
    }



    private function log($user, $message)
    {
        if ($this->logEnabled) {
            Log::info("[user " . $user->id . "] " . $message);
        }
    }
    public function getError()
    {
        return $this->error;
    }
}
