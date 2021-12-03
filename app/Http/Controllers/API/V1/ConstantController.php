<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\CodeGroups;
use App\Http\Requests\OfficeMasterRequest;
use App\Models\ApplicationClass;
use App\Models\Code;
use App\Models\EmploymentStatus;
use App\Models\ReasonForVacation;
use App\Models\RestDeduction;

class ConstantController extends BaseController
{
    public function get()
    {
        $applicationClasses = ApplicationClass::all();
        $reasonForVacations = ReasonForVacation::where(['enable' => true])->get();
        $employmentStatuses = EmploymentStatus::all();
        $restDeductions = RestDeduction::all();

        $codes = Code::select('group', 'key', 'value')->get()->toArray();
        $overtimePayOptions = array_filter($codes, function ($item) {
            return $item['group'] === CodeGroups::OVERTIME_PAY;
        });
        $salaryDeductionOptions = array_filter($codes, function($item) {
            return $item['group'] === CodeGroups::SALARY_DEDUCTION;
        });
        $applicationDeadlineOptions = array_filter($codes, function($item) {
            return $item['group'] === CodeGroups::APPLICATION_DEADLINE;
        });
        $applicationStatusOptions = array_filter($codes, function($item) {
            return $item['group'] === CodeGroups::APPLICATION_STATUS;
        });

        return $this->sendResponse([
            'application_classes'   =>  $applicationClasses,
            'reason_for_vacations'  =>  $reasonForVacations,
            'employment_statuses'   =>  $employmentStatuses,
            'rest_deductions'       =>  $restDeductions,

            'overtime_pay_options'  =>  $overtimePayOptions,
            'salary_deduction_options'=>$salaryDeductionOptions,
            'application_deadline_options'=>    $applicationDeadlineOptions,
            'application_status_options'  =>    $applicationStatusOptions
        ]);
    }
}
