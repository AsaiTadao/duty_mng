<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\WorkingHourQuery;
use App\Http\Requests\WorkingHourRequest;
use App\Models\WorkingHour;

class WorkingHourController extends BaseController
{
    public function get(WorkingHourQuery $query)
    {
        $data = $query->validated();

        $qb = WorkingHour::where([
            ['employment_status_id', '=', $data['employment_status_id']]
        ]);

        if (!empty($data['office_name'])) {
            $qb->whereHas('office', function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data['office_name'] . '%');
            });
        }
        $workingHours = $qb->get();
        return $this->sendResponse($workingHours);
    }
    public function create(WorkingHourRequest $request)
    {
        $data = $request->validated();
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];

        if ($startTime > $endTime)
        {
            return $this->sendError(trans('working_hours.start_gt_end'));
        }
        WorkingHour::create($data);
        return $this->sendResponse();
    }
    public function update(WorkingHour $workingHour, WorkingHourRequest $request)
    {
        $data = $request->validated();
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];

        if ($startTime > $endTime)
        {
            return $this->sendError(trans('working_hours.start_gt_end'));
        }
        $workingHour->fill($data);
        $workingHour->save();
        return $this->sendResponse();
    }
}
