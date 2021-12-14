<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Year;
use App\Models\Office;
use App\Services\StampService;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\WorkStatusCreateRequest;
use App\Http\Requests\WorkStatusUpdateRequest;

use Illuminate\Support\Facades\Log;

class WorkStatusController extends BaseController
{
    protected $stampService;
    public function __construct(StampService $stampService) {
        $this->stampService = $stampService;
    }
    public function get(Office $office, Request $request)
    {
        $user = auth()->user();
        // Todo need to guard
        $data = $request;
        $month = sprintf('%02d', explode("-", $data['date'])[1]);
        $yearId = explode("-", $data['date'])[0] . '04';
        $day = sprintf('%02d', explode("-", $data['date'])[2]);

        $year = Year::where('start', $yearId)->get()[0]->id;
        $employeeQb = User::where('office_id', $office->id);
        $attends = Attendance::where('year_id', $year)
                                ->where('month', $month)
                                ->where('day', $day)
                                ->orderBy('attendances.day')
                                ->get()
                                ->groupBy('user_id');

        $employees = $employeeQb->get();
        $response = [];
        foreach($employees as $employee) {
            $row['user'] = $employee;
            if (empty($attends[$employee->id])) {
                $attend = [];
                $row['attend'] = $attend;
                $response[] = $row;
                continue;
            }

            $attend = [];
            $employeeAttends = $attends[$employee->id][0];
            $items = [];
            $attend = $employeeAttends;
            $row['attend'] = $attend;
            $response[] = $row;
        }
        return $this->sendResponse($response);
    }

    public function update(Attendance $attendance, WorkStatusUpdateRequest $request)
    {
        // Todo need to guard
        $data = $request->validated();
        $attendance->fill($data);
        $attendance->save();
        return $this->sendResponse($attendance);
    }

    public function create(WorkStatusCreateRequest $request)
    {
        $currentUser = auth()->user();
        // Todo need to guard
        $data = $request->validated();
        $stamp = $data['date'];
        $userId = $data['user_id'];
        $createTime = Carbon::parse($stamp);
        $yearNumber = $createTime->year;
        $month = $createTime->month;
        $day = $createTime->day;

        $year = Year::where([
            ['start', '<=',  $yearNumber * 100 + $month],
            ['end', '>=', $yearNumber * 100 + $month]
        ])->first();

        $attendance = Attendance::where([
            'year_id'   =>  $year->id,
            'month'     =>  $month,
            'day'       =>  $day,
            'user_id'   =>  $userId
        ])->first();

        if (!$attendance) {
            $attendance = new Attendance([
                'year_id'   =>  $year->id,
                'month'     =>  $month,
                'day'       =>  $day,
                'day_of_week'=> $createTime->dayOfWeek
            ]);
        }

        $attendance->user_id = $userId;
        $attendance->commuting_time_1 = isset($data['commuting_time_1'])  ? $data['commuting_time_1'] : null;
        $attendance->leave_time_1 = isset($data['leave_time_1']) ? $data['leave_time_1'] : null;
        $attendance->commuting_time_2 = isset($data['commuting_time_2']) ? $data['commuting_time_2'] : null;
        $attendance->leave_time_2 = isset($data['leave_time_2']) ? $data['leave_time_2'] : null;

        $attendance->create_user_id = $currentUser->id;
        $attendance->save();

        return $this->sendResponse($attendance);
    }
}
