<?php

namespace App\Jobs;

use App\Models\Child;
use App\Models\ChildcarePlan;
use App\Models\ChildcarePlanDay;
use App\Services\Child\PlanService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanDayCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $childId;
    protected $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($childId, $userId)
    {
        //
        $this->childId = $childId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PlanService $planService)
    {
        //
        $child = Child::where(['id' => $this->childId])->first();
        if (!$child) return;
        $plans = ChildcarePlan::where(['child_id' => $child->id])->get();
        if ($plans->count() === 0) return;

        $planService->setWeeklyPlan($plans);
        $childPlanDays = $child->dailyPlans;
        $startDate = $child->admission_date;
        if (!$startDate) {
            $startDate = Carbon::now()->format('Y-m-d');
        }
        $date = Carbon::parse($startDate) ;
        $availablePlans = [];
        for ($i = 0; $i < 72; $i++)
        {
            $month = $date->format('Y-m');
            $exisingMonthPlans = $childPlanDays->filter(function($value, $key) use ($month) {
                return Str::startsWith($value->date, $month);
            })->count();
            if (!$exisingMonthPlans)
            {
                $dPlans = $planService->createPlanDaysFromWeeklyPlan($child, $month, $this->userId);
                foreach ($dPlans as $dPlan)
                {
                    if (!$dPlan->start_time && !$dPlan->end_time && $dPlan->absent === null)
                    {
                        continue;
                    }
                    $availablePlans[] = $dPlan;
                }
            }
            $date->addMonth(1);
        }
        if (count($availablePlans)) {
            $child->dailyPlans()->saveMany($availablePlans);
        }
    }
}
