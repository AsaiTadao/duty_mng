<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\OfficeMasterRequest;
use App\Models\ApplicationClass;
use App\Models\EmploymentStatus;
use App\Models\ReasonForVacation;
use App\Models\RestDeduction;

class ConstantController extends BaseController
{
    public function get()
    {
        $applicationClasses = ApplicationClass::all();
        $reasonForVacations = ReasonForVacation::all();
        $employmentStatuses = EmploymentStatus::all();
        $restDeductions = RestDeduction::all();

        return $this->sendResponse([
            'application_classes'   =>  $applicationClasses,
            'reason_for_vacations'  =>  $reasonForVacations,
            'employment_statuses'   =>  $employmentStatuses,
            'rest_deductions'       =>  $restDeductions,
        ]);
    }
}
