<?php

namespace App\Services\Child;

use App\Models\Child;
use App\Models\ChildcarePlan;
use App\Models\ChildcarePlanDay;
use Illuminate\Support\Carbon;

class PlanService
{
    protected $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    public function createPlanDaysFromWeeklyPlan(Child $child, $month)
    {
        $this->holidayService->spanHolidaysInMonth($month);

        $wPlans = ChildcarePlan::where(['child_id' => $child->id])->get();
        $date = Carbon::parse($month . '-01');
        $daysInMonth = $date->daysInMonth;

        $dPlans = [];
        for ($i = 1; $i <= $daysInMonth; $i++)
        {
            $date->day($i);
            $dPlan = new ChildcarePlanDay(['date' => $date->format('Y-m-d')]);
            $dayOfWeek = $date->dayOfWeek;
            // check if holiday
            $isHoliday = $this->holidayService->checkIfHoliday($date);

            $wPlan = $wPlans->first(function($value, $key) use ($dayOfWeek, $isHoliday){
                if ($isHoliday) {
                    return in_array($dayOfWeek, $value->day_of_weeks) && !$value->excluding_holidays;
                }
                return  in_array($dayOfWeek, $value->day_of_weeks);
            });
            if ($wPlan)
            {
                $dPlan->start_time = $wPlan->start_time;
                $dPlan->end_time = $wPlan->end_time;
                $dPlan->absent = 0;
            } else if ($isHoliday || $dayOfWeek === 0) {
                $dPlan->absent = 1;
            }
            $dPlans[] = $dPlan;
        }
        return $dPlans;
    }
}
