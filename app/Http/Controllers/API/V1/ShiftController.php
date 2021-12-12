<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Roles;
use App\Http\Requests\Shift\ShiftQuery;
use App\Http\Requests\Shift\ShiftRequest;
use App\Models\Office;
use App\Models\ShiftPlan;
use App\Models\User;
use App\Services\Processors\ShiftProcessor;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ShiftController extends BaseController
{
    public function get(Office $office, ShiftQuery $request)
    {
        $shift = ShiftPlan::get()->toArray();
        $user = auth()->user();
        if (!Gate::forUser($user)->allows('get-shift-office', $office)) {
            abort(403, "You are not allowed");
        }

        $data = $request->validated();
        $month = (int)$data['month'];
        $year = (int)floor($month / 100);
        $month = $month % 100;

        $qb = DB::table('shift_plans')
            ->join('users', 'shift_plans.user_id', '=', 'users.id')
            ->leftJoin('working_hours', 'shift_plans.working_hours_id', '=', 'working_hours.id');
        $employeeQb = User::whereRaw('1=1');
        if ($user->role_id === Roles::USER_A) {
            $qb->where(['users.id' => $user->id]);
            $employeeQb->where(['id' => $user->id]);
        } else {
            $qb->where('users.office_id', '=', $office->id);
            $employeeQb->where(['office_id' => $office->id]);
        }
        $shifts = $qb->whereYear('shift_plans.date', $year)
            ->whereMonth('shift_plans.date', $month)
            ->orderBy('shift_plans.date')
            ->select(
                'shift_plans.id',
                'shift_plans.date',
                'shift_plans.day_of_week',
                'shift_plans.user_id',
                'shift_plans.start_time',
                'shift_plans.end_time',
                'shift_plans.rest_start_time',
                'shift_plans.rest_end_time',
                'shift_plans.vacation_reason_id',
                'shift_plans.working_hours_id',
                'users.name as user_name',
                'users.office_id',
                'users.number as user_number',
                'users.employment_status_id',
                'users.enrolled',
                'working_hours.name as working_hour_name',
            )
            ->get()
            ->groupBy('user_id');
        $monthCarbon = Carbon::parse($year . '-' . $month . '-01');
        $days = $monthCarbon->daysInMonth;

        $employees = $employeeQb->get();

        $response = [];
        foreach ($employees as $employee) {
            $row = $employee->toArray();
            if (empty($shifts[$employee->id])) {
                $shift = array_fill(0, $days, []);
                $row['shifts'] = $shift;
                continue;
            }

            $shift = [];
            $employeeShifts = $shifts[$employee->id];
            for ($day = 1; $day <= $days; $day++) {
                $employeeShift = $employeeShifts->filter(function ($item) use ($day) {
                    return Carbon::parse($item->date)->day === $day;
                });
                $items = [];
                foreach ($employeeShift as $item) {
                    $items[] = $item;
                }
                $shift[] = $items;
            }
            $row['shifts'] = $shift;
            $response[] = $row;
        }
        return $this->sendResponse($response);
    }

    public function save(Office $office, ShiftRequest $request, ShiftProcessor $shiftProcessor)
    {
        $data = $request->validated();
        $user = User::where(['id' => $data['user_id']])->first();
        $currentUser = auth()->user();

        // check if $currentUser can handle $user's shift
        if (!Gate::forUser($currentUser)->allows('create-shift', [$office, $user])) {
            abort(403, trans("You are not allowed"));
        }
        $date = Carbon::parse($data['date']);
        $shifts = $shiftProcessor->validated($data, $user, $date);
        if ($shifts === false) {
            abort(422, $shiftProcessor->getError());
        }
        if (!$shiftProcessor->save($shifts, $user, $date)) {
            abort(500, $shiftProcessor->getError());
        }
        return $this->sendResponse();
    }
}
