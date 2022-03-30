<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\CodeGroups;
use App\Exports\ChildApplicationTableExport;
use App\Http\Requests\ChildApplicationTableQuery;
use App\Models\Child;
use App\Models\ChildrenAttendence;
use App\Models\ChildrenClass;
use App\Models\Code;
use App\Models\Office;
use App\Models\ReasonForAbsence;
use App\Models\User;
use App\Services\Child\AttendanceService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\PersonalAccessToken;
use Maatwebsite\Excel\Facades\Excel;

class ChildApplicationTableController extends BaseController
{
    protected $childTypes;
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->childTypes = Code::where(['group' => CodeGroups::CHILD_TYPE])->get();
        $this->attendanceService = $attendanceService;
    }
    public function get(Office $office, ChildApplicationTableQuery $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        if (!Gate::forUser($user)->allows('get-child-application-table', $office))
        {
            abort(403, trans('You are not allowed'));
        }
        $table = $this->getTable($office, $data['month']);
        return $this->sendResponse($table);
    }

    public function exportExcel(Office $office, ChildApplicationTableQuery $request)
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

        if (!Gate::forUser($currentUser)->allows('get-child-application-table', $office))
        {
            abort(403, trans('You are not allowed'));
        }

        $data = $request->validated();

        $table = $this->getTable($office, $data['month']);
        $title = $office->name . '_' . $data['month'];
        return Excel::download(new ChildApplicationTableExport($table, $office, $data['month']), $title . '.xlsx');
    }


    private function getTable($office, $date)
    {
        $data = [
            'office_name'   =>  $office->name,
            'employee_count'    =>  $office->users()->count(),
            'capacity'      =>  $office->capacity
        ];
        [$year, $month] = explode('-', $date);

        $children = Child::with('child_info')->where(function($query) {
                $query->whereNull('exit_date')
                    ->orWhere('exit_date', '>', Carbon::now());
            })
            ->where(function($query) {
                $query->where('admission_date', '<=', Carbon::now()->format('Y-m-d'))
                    ->orWhere('admission_date', '=', null);
            })
            ->where(['office_id' => $office->id])
            ->get();
        $data['children_stat'] = [
            ChildrenClass::AGE_0 => $children->where('class_id', ChildrenClass::AGE_0)->count(),
            ChildrenClass::AGE_1 => $children->where('class_id', ChildrenClass::AGE_1)->count(),
            ChildrenClass::AGE_2 => $children->where('class_id', ChildrenClass::AGE_2)->count(),
            ChildrenClass::AGE_3 => $children->where('class_id', ChildrenClass::AGE_3)->count(),
            ChildrenClass::AGE_4 => $children->where('class_id', ChildrenClass::AGE_4)->count(),
            ChildrenClass::AGE_5 => $children->where('class_id', ChildrenClass::AGE_5)->count(),
        ];
        $childEmployeeQuota = $children->filter(function ($value, $key) {
            return $value->child_info && ($value->child_info->type === 1 || $value->child_info->type === 2);
        })->count();
        $childRegional = $children->filter(function ($value, $key) {
            return $value->child_info && ($value->child_info->type === 3 || $value->child_info->type === 4);
        })->count();
        $totalCount = $children->count();
        if (!$totalCount) {
            $employeeQuotaRatio = 0;
            $regionalRatio = 0;
        } else {
            $employeeQuotaRatio = floor($childEmployeeQuota * 100 / $totalCount);
            $regionalRatio = floor($childRegional * 100 / $totalCount);
        }

        $data['children_type_stat'] = [
            'employee_quota'    =>  $childEmployeeQuota,
            'regional'          =>  $childRegional,
            'employee_quota_ratio'=> $employeeQuotaRatio,
            'regional_ratio'    =>  $regionalRatio
        ];


        $attendances = ChildrenAttendence::with('child')
            ->whereHas('child', function ($query) use ($office) {
                $query->where(['office_id' => $office->id]);
            })
            ->where(['month' => $month])
            ->whereYear('date', $year)
            ->get();

        $baseDay = Carbon::parse($date . '-01');
        $daysInMonth = $baseDay->daysInMonth;
        $data['children_stat']['extension_stat'] = [];
        $data['children_stat']['absent_stat'] = [];

        $sumA = 0; $sumB = 0; $sumC = 0; $sumD = 0; $sumE = 0;

        $sumAbsentCorona = 0; $sumAbsentPrivate = 0; $sumAbsentKibiki = 0; $sumAbsentSick = 0; $sumAbsentSuspension = 0; $sumAbsentVacation = 0;

        for ($i = 1; $i <= $daysInMonth; $i++)
        {
            $targetDate = $baseDay->day($i)->format('Y-m-d');
            $a = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && !$value->extension_in_minute;
            })->count();
            $b = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->extension_in_minute && $value->extension_in_minute <= 30;
            })->count();
            $c = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->extension_in_minute && $value->extension_in_minute > 30 && $value->extension_in_minute <= 60;
            })->count();
            $d = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->extension_in_minute && $value->extension_in_minute > 60 && $value->extension_in_minute <= 90;
            })->count();
            $e = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->extension_in_minute && $value->extension_in_minute > 90;
            })->count();
            $data['children_stat']['extension_stat'][$i] = compact('a', 'b', 'c', 'd', 'e');

            $sumA += $a; $sumB += $b; $sumC += $c; $sumD += $d; $sumE += $e;

            $sumAbsentCorona = 0; $sumAbsentPrivate = 0; $sumAbsentKibiki = 0; $sumAbsentSick = 0; $sumAbsentSuspension = 0; $sumAbsentVacation = 0;

            $absentCorona = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_CORONA;
            })->count();
            $absentPrivate = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_PRIVATE;
            })->count();
            $absentKibiki = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_KIBIKI;
            })->count();
            $absentSick = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_SICK;
            })->count();
            $absentSuspension = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_SUSPENSION;
            })->count();
            $absentVacation = $attendances->filter(function ($value, $key) use ($targetDate) {
                return $value->date === $targetDate && $value->reason_for_absence_id === ReasonForAbsence::REASON_VACATION;
            })->count();

            $data['children_stat']['absent_stat'][$i] = [
                ReasonForAbsence::REASON_CORONA =>  $absentCorona,
                ReasonForAbsence::REASON_PRIVATE    =>  $absentPrivate,
                ReasonForAbsence::REASON_KIBIKI =>  $absentKibiki,
                ReasonForAbsence::REASON_SICK   =>  $absentSick,
                ReasonForAbsence::REASON_SUSPENSION =>  $absentSuspension,
                ReasonForAbsence::REASON_VACATION   =>  $absentVacation,
            ];
            $sumAbsentCorona += $absentCorona;
            $sumAbsentPrivate += $absentPrivate;
            $sumAbsentKibiki += $absentKibiki;
            $sumAbsentSick += $absentSick;
            $sumAbsentSuspension += $absentSuspension;
            $sumAbsentVacation += $absentVacation;

        }

        $data['children_stat']['extension_stat_sum'] = [
            'a' =>  $sumA,
            'b' =>  $sumB,
            'c' =>  $sumC,
            'd' =>  $sumD,
            'e' =>  $sumE,
        ];

        $data['children_stat']['absent_stat_sum'] = [
            ReasonForAbsence::REASON_CORONA =>  $sumAbsentCorona,
            ReasonForAbsence::REASON_PRIVATE    =>  $sumAbsentPrivate,
            ReasonForAbsence::REASON_KIBIKI =>  $sumAbsentKibiki,
            ReasonForAbsence::REASON_SICK   =>  $sumAbsentSick,
            ReasonForAbsence::REASON_SUSPENSION =>  $sumAbsentSuspension,
            ReasonForAbsence::REASON_VACATION   =>  $sumAbsentVacation,
        ];

        $childrenClasses = ChildrenClass::get();

        $childTable = [];
        foreach ($childrenClasses as $childrenClass)
        {
            $classChildren = $children->filter(function ($value, $key) use ($childrenClass) {
                return $value->class_id === $childrenClass->id;
            });
            $childTable[$childrenClass->id] = [];
            foreach ($classChildren as $child)
            {
                [$attendCount, $absentCount] = $this->attendanceService->countMonthlyAttend($child, $date);
                $exitDate = Carbon::parse($child->exit_date);
                if ($child->exit_date && $exitDate->format('Y-m') === $date)
                {
                    $currentExitDate = $exitDate->format('d日');
                } else {
                    $currentExitDate = '';
                }
                $childItem = [
                    'number'    =>  $child->number,
                    'name'      =>  $child->name,
                    'birthday'  =>  $child->birthday ? Carbon::parse($child->birthday)->format('Y-m-d') : '',
                    'type'      =>  $this->getChildTypeLabel($child),
                    'company_name'  =>  $child->company_name,
                    'admission_date'    =>  $child->admission_date,
                    'free_of_charge' => $child->free_of_charge_label,
                    'certificate_of_payment'    =>  $child->certificate_of_payment_label,
                    'certificate_expiration_date'=> $child->certificate_expiration_date_label,
                    'tax_exempt_household'      =>  $child->tax_exempt_household_label,
                    'attend_count'              =>  $attendCount,
                    'absent_count'              =>  $absentCount,
                    'exit_date'  => $currentExitDate
                ];
                $childAttendances = $attendances->filter(function ($value, $key) use ($child){
                    return $value->child_id === $child->id;
                });

                $extensionState = [];
                $absentState = [
                    ReasonForAbsence::REASON_CORONA =>  0,
                    ReasonForAbsence::REASON_PRIVATE    =>  0,
                    ReasonForAbsence::REASON_KIBIKI =>  0,
                    ReasonForAbsence::REASON_SICK   =>  0,
                    ReasonForAbsence::REASON_SUSPENSION =>  0,
                    ReasonForAbsence::REASON_VACATION   =>  0,
                    ReasonForAbsence::REASON_HOLIDAY   =>  0,
                ];

                for ($i = 1; $i <= $daysInMonth; $i++)
                {
                    $attendance = $childAttendances->firstWhere('day', $i);
                    if ($attendance)
                    {
                        if ($attendance->extension_in_minute > 90) $extensionState[$i] = 'E';
                        else if ($attendance->extension_in_minute > 60) $extensionState[$i] = 'D';
                        else if ($attendance->extension_in_minute > 30) $extensionState[$i] = 'C';
                        else if ($attendance->extension_in_minute > 0) $extensionState[$i] = 'B';
                        else $extensionState[$i] = 'A';
                        if ($attendance->reason_for_absence_id)
                        {
                            $extensionState[$i] = $attendance->reason_for_absence->ruby;
                            $absentState[$attendance->reason_for_absence_id]++;
                        }
                    } else {
                        $extensionState[$i] = '';
                    }
                }
                $childItem['extension_state'] = $extensionState;
                $childItem['absent_state'] = $absentState;

                $childTable[$childrenClass->id][] = $childItem;
            }
        }
        $data['children_table'] = $childTable;

        return $data;

    }
    private function getChildTypeLabel($child)
    {
        if (!$child->child_info) return '';
        $childType = $this->childTypes->first(function ($value, $key) use ($child){
            return $value->key === $child->child_info->type;
        });
        if (!$childType) return '';
        return $childType->value;
    }

}
