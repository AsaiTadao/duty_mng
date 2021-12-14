<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Attendance;
use App\Models\Year;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends BaseController
{
    public function create(ApplicationRequest $request)
    {
        $currentUser = auth()->user();

        $data = $request->validated();
        if (empty($data['attendance_id']) && empty($data['application_date'])) {
            return $this->sendError("Please input date or select attendance", [], 422);
        }

        $attendance = null;
        if (!empty($data['attendance_id'])) {
            $attendance = Attendance::where(['id' => $data['attendance_id'], 'user_id' => $currentUser->id])->get();
        }
        if (!$attendance) {
            $applicationDate = Carbon::parse($data['application_date']);
            $monthValue = $applicationDate->year * 100 + $applicationDate->month;
            $year = Year::where([
                ['start', '<=', $monthValue],
                ['end', '>=', $monthValue]
            ])->first();
            $attendance = Attendance::where([
                'year_id'   =>  $year->id,
                'month'     =>  $applicationDate->month,
                'day'       =>  $applicationDate->day,
                'user_id'   =>  $currentUser->id
            ])->first();
            if (!$attendance) {
                $attendance = new Attendance([
                    'year_id'   =>  $year->id,
                    'month'     =>  $applicationDate->month,
                    'day'       =>  $applicationDate->day,
                    'day_of_week'=> $applicationDate->dayOfWeek
                ]);
                $attendance->user()->associate($currentUser);
                $attendance->save();
            }
        }

        $application = new Application([
            'attendance_id'         =>  $attendance->id,
            'application_class_id'  =>  $data['application_class_id']??null,
            'reason'                =>  $data['reason']??null,
            'time_before_correction'=>  $data['time_before_correction']??null,
            'time_after_correction' =>  $data['time_after_correction']??null,
        ]);
        $application->application_datetime = Carbon::now();
        $application->create_user_id = $currentUser->id;
        $application->user()->associate($currentUser);
        $application->save();
        return $this->sendResponse($application);
    }
    public function update(Application $application, ApplicationRequest $request)
    {
        $currentUser = auth()->user();
        if (!Gate::allows('update-application', $application)) {
            return abort(403, "You are not allowed");
        }
        $data = $request->validated();
        if ($application->attendance_id !== $data['attendance_id']) {
            return abort(403, 'attendance not matched');
        }
        $application->fill($request->validated());
        $application->update_user_id = $currentUser->id;
        $application->save();
        return $this->sendResponse($application);
    }
    public function approve(Application $application)
    {
        if (!Gate::allows('approve-application', $application)) {
            return abort(403, "You are not allowed");
        }
        $currentUser = auth()->user();
        if ($application->is_approved) return $this->sendError("Already approved", [], 202);
        $application->approval_datetime = Carbon::now();
        $application->update_user_id = $currentUser->id;
        $application->save();
        return $this->sendResponse($application);
    }
}
