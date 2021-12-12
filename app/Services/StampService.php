<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\ShiftPlan;
use App\Models\Year;
use Carbon\Carbon;
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
        }
        if (!$attendance->commuting_time_2 && !$attendance->leave_time_2) {
            if (!empty($shifts[1])) {
                if ($stampTime <= $shifts[0]->end_time) {
                    $attendance->shift1->associcate($shifts[0]);
                    $this->log($user, "getMatchedShift return 13 postion");
                    $attendance->commuting_time_2 = $stamp;
                    return [
                        'attendance'    =>  $attendance,
                        'number'        =>  2
                    ];
                }
            } else {
                $this->log($user, "getMatchedShift return 14 postion");
                $attendance->commuting_time_2 = $stamp;
                return [
                    'attendance'    =>  $attendance,
                    'number'        =>  2
                ];
            }
        }
        // eoc: check beyond shifts
        $this->log($user, "getMatchedShift return 15 postion");
        return null;
    }

    /**
     * DO NOT SAVE attendance here
     * process $user's stamp data and fill attendance data
     * @return Attendance $attendance
     * null: error
     */
    public function leave($user, $stamp)
    {
        [$attendance, $shifts] = $this->getAttendanceShifts($user, $stamp);

        if ($attendance->leave_time_2) {
            $this->error = "Trying to leave stamp 3 or more times";
            return false;
        }
        if ($attendance->commuting_time_2 || $attendance->leave_time_1) {
            $attendance->leave_time_2 = $stamp;
            return $attendance;
        }

        if ($shifts->count() === 0 || $shifts->count() === 1) {
            $attendance->leave_time_1 = $stamp;
            return $attendance;
        }

        if ($stamp->format('H:i:s') > $shifts[1]->start_time) {
            $diffWithFirst = Carbon::parse($stamp->format('Y-m-d') . ' ' . $shifts[0]->end_time)->floatDiffInMinutes($stamp);
            $diffWitSecond = Carbon::parse($stamp->format('Y-m-d') . ' ' . $shifts[1]->end_time)->floatDiffInMinutes($stamp);
            if ($diffWitSecond < $diffWithFirst) {
                $attendance->leave_time_2 = $stamp;
                return $attendance;
            }
        }
        $attendance->leave_time_1 = $stamp;
        return $attendance;
    }

    private function getAttendanceShifts($user, $stamp)
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
            ]);
            $attendance->user()->associate($user);
        }
        return [$attendance, $shifts];
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
