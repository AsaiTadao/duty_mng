<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\CodeGroups;
use App\Http\Requests\ChildApplicationTableQuery;
use App\Models\Child;
use App\Models\ChildrenAttendence;
use App\Models\ChildrenClass;
use App\Models\Code;
use App\Models\Office;
use App\Models\User;
use App\Services\Child\AttendanceService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

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

    private function getTable($office, $date)
    {
        $data = [
            'office_name'   =>  $office->name,
            'employee_count'    =>  $office->users()->count()
        ];
        [$year, $month] = explode('-', $date);

        $children = Child::with('child_info')
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
        $employeeQuotaRatio = floor($childEmployeeQuota * 100 / $totalCount);
        $regionalRatio = floor($childRegional * 100 / $totalCount);

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
        for ($i = 1; $i <= $daysInMonth; $i++)
        {
            $date = $baseDay->day($i)->format('Y-m-d');
            $a = $attendances->filter(function ($value, $key) use ($date) {
                return $value->date === $date && !$value->extension;
            })->count();
            $b = $attendances->filter(function ($value, $key) use ($date) {
                return $value->date === $date && $value->extension && $value->extension <= 30;
            })->count();
            $c = $attendances->filter(function ($value, $key) use ($date) {
                return $value->date === $date && $value->extension && $value->extension > 30 && $value->extension <= 60;
            })->count();
            $d = $attendances->filter(function ($value, $key) use ($date) {
                return $value->date === $date && $value->extension && $value->extension > 60 && $value->extension <= 90;
            })->count();
            $e = $attendances->filter(function ($value, $key) use ($date) {
                return $value->date === $date && $value->extension && $value->extension > 90;
            })->count();
            $data['children_stat']['extension_stat'][$i] = compact('a', 'b', 'c', 'd', 'e');
        }

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
                if ($exitDate->format('Y-m') === $date)
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

                for ($i = 1; $i <= $daysInMonth; $i++)
                {
                    $attendance = $childAttendances->firstWhere('day', $i);
                    if ($attendance)
                    {
                        if ($attendance->extension > 90) $extensionState[$i] = 'E';
                        else if ($attendance->extension > 60) $extensionState[$i] = 'D';
                        else if ($attendance->extension > 30) $extensionState[$i] = 'C';
                        else if ($attendance->extension > 0) $extensionState[$i] = 'B';
                        else $extensionState[$i] = 'A';
                    } else {
                        $extensionState[$i] = '';
                    }
                }
                $childItem['extension_state'] = $extensionState;

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
