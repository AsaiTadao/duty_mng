<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\AttendanceStatus\AttendanceStatusQuery;
use App\Models\Attendance;
use App\Models\Year;
use App\Services\AttendanceTotalService;

class AttendanceStatusController extends BaseController
{
    public function index(AttendanceStatusQuery $request, AttendanceTotalService $service)
    {
        $currentUser = auth()->user();

        $data = $request->validated();
        [$attendances, $attendanceTotal] = $service->calculateAttendanceTotal($currentUser, $data['month']);

        return $this->sendResponse([
            'attendance'    =>  $attendances,
            'total'         =>  $attendanceTotal
        ]);
    }
}
