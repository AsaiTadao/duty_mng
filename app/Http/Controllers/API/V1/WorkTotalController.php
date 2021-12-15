<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\WorkTotal\WorkTotalQuery;
use App\Models\Office;
use App\Services\AttendanceTotalService;
use Illuminate\Support\Facades\Gate;

class WorkTotalController extends BaseController
{
    public function get(Office $office, WorkTotalQuery $request, AttendanceTotalService $attendanceTotalService)
    {
        $currentUser = auth()->user();
        $data = $request->validated();
        if (!Gate::forUser($currentUser)->allows('get-office-work-total', $office)) {
            abort(403, "You are not allowed");
        }
        $users = $office->users;

        $totals = [];
        foreach($users as $user)
        {
            [$attendances, $attendanceTotal] = $attendanceTotalService->calculateAttendanceTotal($user, $data['month']);
            $item = $user->toArray();
            $item['total'] = $attendanceTotal;

            $totals[] = $item;
        }
        return $this->sendResponse($totals);
    }
}
