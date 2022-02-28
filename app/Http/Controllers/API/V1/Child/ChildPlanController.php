<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\ChildPlanDayQuery;
use App\Http\Requests\Child\ChildPlanDayRequest;
use App\Http\Requests\Child\ChildPlanRequest;
use App\Http\Resources\ChildcarePlanDayResource;
use App\Models\Child;
use App\Models\ChildcarePlan;
use App\Models\ChildcarePlanDay;
use App\Services\Child\PlanService;
use Illuminate\Support\Carbon;

class ChildPlanController extends BaseController
{
    public function retrieve(Child $child)
    {
        $childPlans = ChildcarePlan::where(['child_id' => $child->id])->get();

        return $this->sendResponse($childPlans);
    }

    public function save(Child $child, ChildPlanRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $childPlans = [];
        foreach ($data['data'] as $plan)
        {
            if (!empty($plan['id']))
            {
                $childPlan = ChildcarePlan::where(['id' => $plan['id'], 'child_id' => $child->id])->first();
                $childPlan->fill($plan);
                $childPlan->update_user_id = $user->id;
            } else {
                $childPlan = new ChildcarePlan($plan);
                $childPlan->child_id = $child->id;
                $childPlan->create_user_id = $user->id;
                $childPlan->update_user_id = $user->id;
            }
            $childPlan->save();
            $childPlans[] = $childPlan;
        }
        if (!$child->plan_registered) {
            $child->plan_registered = true;
            $child->save();
        }
        return $this->sendResponse($childPlans);
    }
    public function retrieveDailyPlan(Child $child, ChildPlanDayQuery $request, PlanService $planService)
    {
        $data = $request->validated();
        $month = $data['month'];
        [$year, $month] = explode('-', $data['month']);
        $planDays = ChildcarePlanDay::where(['child_id' => $child->id])->whereYear('date', $year)->whereMonth('date', $month)->get();

        if ($planDays->count() === 0)
        {
            $planDays = $planService->createPlanDaysFromWeeklyPlan($child, $data['month']);
        }
        return $this->sendResponse(ChildcarePlanDayResource::collection($planDays));
    }
    public function saveDayPlan(Child $child, ChildPlanDayRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $month = $data['month'];
        [$year, $month] = explode('-', $data['month']);

        $planDays = ChildcarePlanDay::where(['child_id' => $child->id])->whereYear('date', $year)->whereMonth('date', $month)->get();
        foreach ($data['data'] as $plan)
        {
            $date = $plan['date'];
            $planDay = $planDays->first(function($value, $key) use ($date){
                return $value->date->format('Y-m-d') === $date;
            });
            if ($planDay)
            {
                $planDay->fill($plan);
            } else {
                $planDay = new ChildcarePlanDay(['child_id' => $child->id]);
                $planDay->fill($plan);
                $planDay->create_user_id = $user->id;
            }
            $planDay->update_user_id = $user->id;
            if (!$planDay->absent) {
                $planDay->absent = 0;
            }
            $planDay->save();
        }

        if (!$child->plan_registered) {
            $child->plan_registered = true;
            $child->save();
        }
        return $this->sendResponse();
    }
}
