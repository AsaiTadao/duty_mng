<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\PageQuery;
use App\Http\Requests\ReasonForVacationEnableRequest;
use App\Http\Requests\ReasonForVacationRequest;
use App\Models\ReasonForVacation;
use App\Models\User;

class VacationReasonController extends BaseController
{
    public function get()
    {
        $data = ReasonForVacation::get();
        return $this->sendResponse($data);
    }
    public function create(ReasonForVacationRequest $request)
    {
        $data = $request->validated();
        ReasonForVacation::create($data);
        return $this->sendResponse($data);
    }
    public function update(ReasonForVacation $reasonForVacation, ReasonForVacationRequest $request)
    {
        $reasonForVacation->fill($request->validated());
        $reasonForVacation->save();
        return $this->sendResponse($reasonForVacation);
    }
    public function updateStatus(ReasonForVacation $reasonForVacation, ReasonForVacationEnableRequest $request)
    {
        $data = $request->validated();
        $reasonForVacation->enable = $data['enable'];
        $reasonForVacation->save();
        return $this->sendResponse();
    }

    public function delete(ReasonForVacation $reasonForVacation)
    {
        $reasonForVacation->delete();
        return $this->sendResponse();
    }
}
