<?php

namespace App\Services\Child;

use App\Models\Child;
use App\Models\ChildcarePlanDay;
use App\Models\ChildrenAttendence;

class AttendanceService
{
    /**
     * @param Child $child
     * @param string $month 'Y-m'
     * @return [monthlyAttendCount, monthlyAbsentCount]
     */
    public function countMonthlyAttend(Child $child, $month)
    {
        [$year, $month] = explode('-', $month);
        $plans = ChildcarePlanDay::where(['child_id' => $child->id])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)->whereNull('absent_id')
                ->get();
        $attends = ChildrenAttendence::where(['child_id' => $child->id])
                ->where(['month' => $month])
                ->whereYear('date', $year)
                ->whereNull('reason_for_absence_id')
                ->get();
        $attendCount = $attends->count();

        $absentCount = ChildrenAttendence::where(['child_id' => $child->id])
            ->where(['month' => $month])
            ->whereYear('date', $year)
            ->whereNotNull('reason_for_absence_id')
            ->count();
        // foreach ($plans as $plan)
        // {
        //     if (!$attends->where('date', $plan->date)->count())
        //     {
        //         $absentCount++;
        //     }
        // }
        return [$attendCount, $absentCount];
    }
}
