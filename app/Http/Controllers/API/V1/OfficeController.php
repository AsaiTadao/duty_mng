<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\OfficeMasterRequest;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OfficeController extends BaseController
{
    public function get()
    {
        $offices = Office::get();
        return $this->sendResponse($offices->toArray());
    }
    public function create(OfficeMasterRequest $request)
    {
        $data = $request->validated();
        $office = Office::create($data);
        return $this->sendResponse($office);
    }

    public function update(Office $office, OfficeMasterRequest $request)
    {
        $data = $request->validated();
        $office->fill($data);
        $office->save();
        return $this->sendResponse($office);
    }
}
