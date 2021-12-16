<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Requests\MonthlySummary\MonthlySummaryQuery;
use App\Models\User;
use App\Services\AttendanceTotalService;
use Illuminate\Support\Facades\Gate;

class MonthlySummaryController extends BaseController
{
    public function get(MonthlySummaryQuery $request, User $user, AttendanceTotalService $attendanceTotalService)
    {
        $currentUser = auth()->user();
        if (!Gate::forUser($currentUser)->allows('get-user-summary', $user)) {
            abort(403, "You are not allowed");
        }
        $data = $request->validated();

        [$attendances, $attendanceTotal, $attendanceMetaItems] = $attendanceTotalService->calculateAttendanceTotal($currentUser, $data['month']);

        $attendanceItems = [];
        foreach($attendances as $i => $attendance)
        {
            $item = $attendance->toArray();
            $attendanceItems[] = array_merge($item, $attendanceMetaItems[$i]);
        }

        return $this->sendResponse([
            'attendance'    =>  $attendanceItems,
            'total'         =>  $attendanceTotal
        ]);
    }

}
