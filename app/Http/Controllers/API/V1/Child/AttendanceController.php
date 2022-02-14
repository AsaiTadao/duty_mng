<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\AttendanceQuery;
use App\Http\Requests\Child\AttendanceRequest;
use App\Models\Child;
use App\Models\ChildrenAttendence;
use App\Models\Year;
use Illuminate\Support\Carbon;

class AttendanceController extends BaseController
{
    public function save(Child $child, AttendanceRequest $request)
    {
        $data = $request->validated();
        [$year, $month, $day] = explode('-', $data['date']);
        $monthValue = $year * 100 + $month;
        $Year = Year::where([
            ['start', '<=', $monthValue],
            ['end', '>=', $monthValue]
        ])->first();
        $attendance = ChildrenAttendence::where([
            'year_id'   =>  $Year->id,
            'month'     =>  (int)$month,
            'day'       =>  (int)$day,
            'child_id'  => $child->id
        ])->first();

        if (!$attendance)
        {
            $attendance = new ChildrenAttendence([
                'year_id'   =>  $Year->id,
                'month'     =>  $month,
                'day'       =>  $day,
                'child_id'  =>  $child->id
            ]);
        }
        $attendance->fill([
            'year_id'   =>  $Year->id,
            'month'     =>  $month,
            'day'       =>  $day,
            'date'      =>  $data['date'],
            'commuting_time'    =>  !empty($data['commuting_time']) ? Carbon::parse($data['date'] . ' ' .  $data['commuting_time']) : null,
            'leave_time'=>  !empty($data['leave_time']) ? Carbon::parse($data['date'] . ' ' .  $data['leave_time']) : null,
            'reason_for_absence_id' =>  $data['reason_for_absence_id']??null,
            'behind_time'=> $data['behind_time']??null,
            'extension'  => $data['extension']??null
        ]);
        $attendance->save();
        return response()->json($attendance);
    }
    // public function getAttendances(AttendanceQuery $request)
    // {
    //     $user = auth()->user();
    //     $data = $request->validated();
    //     [$year, $month, $day] = explode('-', $data['date']);
    //     $monthValue = $year * 100 + $month;
    //     $Year = Year::where([
    //         ['start', '<=', $monthValue],
    //         ['end', '>=', $monthValue]
    //     ])->first();
    //     ChildrenAttendence::where([
    //         'year_id'   =>  $Year->id,
    //         'month'     =>  (int)$month,
    //         'day'       =>  (int)$day,
    //         ''
    //     ]);
    // }
}
