<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Exports\MonthlyAttendanceExport;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\AttendanceDailyStatQuery;
use App\Http\Requests\Child\AttendanceMonthlyQuery;
use App\Http\Requests\Child\AttendanceQuery;
use App\Http\Requests\Child\AttendanceRequest;
use App\Http\Resources\ChildAttendanceResource;
use App\Models\Child;
use App\Models\ChildcarePlanDay;
use App\Models\ChildrenAttendence;
use App\Models\ContactBook;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class AttendanceController extends BaseController
{
    use ChildcareAuthUserTrait;

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
        return $this->sendResponse($attendance);
    }
    public function list(AttendanceQuery $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        [$year, $month, $day] = explode('-', $data['date']);
        $monthValue = $year * 100 + $month;
        $Year = Year::where([
            ['start', '<=', $monthValue],
            ['end', '>=', $monthValue]
        ])->first();

        // $childrenIds = Child::where(['office_id' => $user->office_id])->get()->pluck('id')->toArray();
        $childrenAttendences = DB::table('children')->where(['office_id' => $user->office_id])
            ->whereNull('canceled_at')
            ->leftJoin('children_attendences', function ($join) use ($Year, $month, $day) {
                $join->on('children_attendences.child_id', '=', 'children.id')
                    ->where([
                        'children_attendences.year_id'  =>  $Year->id,
                        'children_attendences.month'  =>  (int)$month,
                        'children_attendences.day'  =>  (int)$day,
                    ]);
            })
            ->where(function($query) use($data) {
                $query->where('children.exit_date', '>=', $data['date'])
                    ->orWhere('children.exit_date', '=', null);
            })
            ->where(function($query) use($data) {
                $query->where('children.admission_date', '<=', $data['date'])
                    ->orWhere('children.admission_date', '=', null);
            })
            ->select('children_attendences.*', 'children.id', 'children.class_id', 'children.name')
            ->get();
        return $this->sendResponse(ChildAttendanceResource::collection($childrenAttendences));
    }

    public function monthlyList(Child $child, AttendanceMonthlyQuery $request)
    {
        $user = $this->getUser();
        if (!Gate::forUser($user)->allows('handle-child', $child))
        {
            abort(403, trans('You are not allowed'));
        }
        $data = $request->validated();
        [$year, $month] = explode('-', $data['month']);
        $attendances = ChildrenAttendence::where(['child_id' => $child->id, 'month' => $month])
        ->whereYear('date', $year)
        ->get();
        $planDays = ChildcarePlanDay::where(['child_id' => $child->id])
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
        $baseDate = Carbon::parse($data['month'] . '-01');
        $daysInMonth = $baseDate->daysInMonth;
        $result = [];
        for ($i = 0; $i < $daysInMonth; $i++)
        {
            $baseDate->day($i + 1);
            $item = [
                'id'=> null,
                'commuting_time'=> null,
                'leave_time'=> null,
                'reason_for_absence_id'=> null,
                'extension'=> '',
                'no_schedule'   =>  false,
                'day'   =>  $i + 1,
            ];

            $attendance = $attendances->firstWhere('date', $baseDate->format('Y-m-d'));
            $plan = $planDays->first(function($value) use ($baseDate) {
                return $value->date->timestamp == $baseDate->timestamp;
            });
            if ($attendance) {
                $item = $attendance->toArray();
            }
            // if ((!$plan || $plan->absent_id || !$plan->start_time || !$plan->end_time) && !$item['reason_for_absence_id']) {
            //     $item['no_schedule'] = true;
            // }
            // if (!$item['commuting_time'] && !$item['reason_for_absence_id'] && $plan && $plan->absent_id)
            // {
            //     $item['reason_for_absence_id'] = $plan->absent_id;
            // }
            if ($plan && $plan->absent_id) {
                $item['no_schedule'] = true;
                $item['reason_for_absence_id'] = $plan->absent_id;
            }

            $contact_status = ContactBook::STATUS_INCOMPLETE;
            $contactBook = ContactBook::whereDate('date', $baseDate->format('Y-m-d'))->where(['child_id' => $child->id])->first();
            if ($contactBook)
            {
                $contact_status = $contactBook->status;
            }
            $item['contact_status'] = $contact_status;

            /** exclude before admission date and after exit_date */
            if ($child->admission_date && $baseDate->format('Y-m-d') < $child->admission_date) {
                $item['exclude'] = true;
            }

            if ($child->exit_date && $baseDate->format('Y-m-d') > $child->exit_date) {
                $item['exclude'] = true;
            }

            $result[] = $item;
        }
        return $this->sendResponse($result);
    }
    public function monthlyListCsv(Child $child, AttendanceMonthlyQuery $request)
    {
        if (!$request->has('token'))
        {
            abort(403, "You are not allowed");
        }
        $token = $request->input('token');
        $token = PersonalAccessToken::findToken($token);

        if (!$token) {
            abort(403, "You are not allowed");
        }
        $currentUser = $token->tokenable;
        if (!$currentUser) {
            abort(403, "You are not allowed");
        }
        if (!Gate::forUser($currentUser)->allows('handle-child', $child))
        {
            abort(403, trans('You are not allowed'));
        }
        $data = $request->validated();
        [$year, $month] = explode('-', $data['month']);
        $attendances = ChildrenAttendence::where(['child_id' => $child->id, 'month' => $month])
            ->whereYear('date', $year)
            ->get();
        $fileName = $child->name . '_' . $data['month'] . '登降園管理';
        return Excel::download(new MonthlyAttendanceExport($attendances, $data['month']), $fileName . '.csv', ExcelExcel::CSV);
    }

    public function dailyStat(AttendanceDailyStatQuery $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $office_id = $user->office_id;

        $childQb = Child::where(['office_id' => $office_id])
        ->where(function($query) use ($data) {
            $query->whereNull('exit_date')
                ->orWhere('exit_date', '>=', $data['date']);
        })
        ->where(function($query) use ($data) {
            $query->where('admission_date', '<=', $data['date'])
                ->orWhere('admission_date', '=', null);
        });
        if (!empty($data['children_class_id']))
        {
            $childQb->where(['class_id' => $data['children_class_id']]);
        }
        $children = $childQb->get();
        $allCount = $children->count();

        $attendanceCount = ChildrenAttendence::where(['date' => $data['date']])
                ->whereIn('child_id', $children->pluck('id')->toArray())
                ->whereNotNull('commuting_time')
                ->count();

        $absentCount = $allCount - $attendanceCount;

        return $this->sendResponse([
            'all'   =>  $allCount,
            'attend'=>  $attendanceCount,
            'absent'=>  $absentCount
        ]);
    }
}
