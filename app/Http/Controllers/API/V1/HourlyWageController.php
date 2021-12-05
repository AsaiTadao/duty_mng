<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\HourlyWageRequest;
use App\Models\HourlyWage;

class HourlyWageController extends BaseController
{
    public function get()
    {
        $hourlyWages = HourlyWage::get();
        return $this->sendResponse($hourlyWages);
    }
    public function create(HourlyWageRequest $request)
    {
        $data = $request->validated();

    }
}
