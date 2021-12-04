<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\OfficeMasterRequest;
use App\Http\Requests\ScheduledWorkingRequest;
use App\Models\Office;
use App\Models\ScheduledWorking;
use App\Models\User;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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

    public function delete(Office $office)
    {
        $office->delete();
        return $this->sendResponse();
    }

    public function getScheduleWorkings(Office $office)
    {
        $now = Carbon::now();
        $currentYearValue = $now->year * 100 + $now->month;
        $nextYearValue = $currentYearValue + 100;

        $currentYear = Year::where([
            ['start', '<=', $currentYearValue],
            ['end', '>=', $currentYearValue]
        ])->first();
        $nextYear = Year::where([
            ['start', '<=', $nextYearValue],
            ['end', '>=', $nextYearValue]
        ])->first();
        $currentYearScheduleValues = ScheduledWorking::where([
            ['year_id', '=', $currentYear->id],
            ['office_id', '=',  $office->id]
        ])->orderBy('month')->get()->toArray();
        $nextYearScheduleValues = ScheduledWorking::where([
            ['year_id' , '=', $nextYear->id],
            ['office_id', '=',  $office->id]
        ])->get()->toArray();

        $currentYearSchedules = $this->formatScheduleWorkings($currentYearScheduleValues, $currentYear);
        $nextYearSchedules = $this->formatScheduleWorkings($nextYearScheduleValues, $nextYear);

        return $this->sendResponse([
            'current'   =>  $currentYearSchedules,
            'next'      =>  $nextYearSchedules
        ]);
    }
    public function saveScheduleWorking(Office $office, ScheduledWorkingRequest $request)
    {
        $data = $request->validated();
        $scheduledWorkings = ScheduledWorking::where([
            ['year_id', '=', $data['year_id']],
            ['office_id', '=', $office->id]
        ])->get();

        $schedules = $data['schedules'];
        foreach ($schedules as $schedule)
        {
            $scheduleWorking = Arr::first($scheduledWorkings, function($value, $key) use ($schedule) {
                return $value->month === $schedule['month'];
            });
            if ($scheduleWorking) {
                $scheduleWorking->days = $schedule['days'];
                $scheduleWorking->save();
            } else {
                $scheduleWorking = ScheduledWorking::create([
                    'year_id'   =>  $data['year_id'],
                    'month'     =>  $schedule['month'],
                    'days'      =>  $schedule['days']??null,
                    'office_id' =>  $office->id,
                ]);
            }
        }
        return $this->sendResponse();
    }

    private function formatScheduleWorkings($scheduleWorkingValues, $year)
    {
        $yearStartMonth = $year->start % 100;
        $yearStartYear = floor($year->start / 100);
        $yearEndYear = floor($year->end / 100);

        $yearSchedules = [];
        for ($i = 0; $i < 12; $i++)
        {
            $month = ($yearStartMonth + $i - 1) % 12 + 1;
            $scheduleWorking = Arr::first($scheduleWorkingValues, function($value, $key) use ($month) {
                return $value['month'] === $month;
            });
            if (!$scheduleWorking) {
                $scheduleWorking = [
                    'year_id'   =>  $year->id,
                    'month'     =>  $month,
                ];
            }
            if ($month >= $yearStartMonth) {
                $scheduleWorking['year'] = $yearStartYear;
            } else {
                $scheduleWorking['year'] = $yearEndYear;
            }

            $yearSchedules[] = $scheduleWorking;
        }
        return $yearSchedules;
    }
}
