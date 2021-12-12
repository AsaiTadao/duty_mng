<?php

namespace App\Http\Controllers\API\V1;

use App\Services\Processors\AttendanceProcessor;
use App\Services\StampService;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Result;
use Illuminate\Support\Facades\Log;

class ShiftController extends BaseController
{
    protected $stampService;
    protected $attendanceProcessor;

    public function __construct(
        StampService $stampService,
        AttendanceProcessor $attendanceProcessor
    ) {
        $this->stampService = $stampService;
        $this->attendanceProcessor = $attendanceProcessor;
    }
    public function commute()
    {
        $user = auth()->user();
        $stamp = Carbon::now();
        Log::info("[user " . $user->id . "] trying to commute stamp");

        $result = $this->stampService->commute($user, $stamp);
        if (!$result) {
            Log::error("[user " . $user->id . "] commute stamp error : " . $this->stampService->getError());
            $this->stampService->getError();
            return $this->sendError($this->stampService->getError());
        }
        [$attendance, $number] = $result;
        Log::info("[user " . $user->id . "] commute stamp number : " . $number);

        if (!$attendance->id) {
            $attendance->create_user_id = $user->id;
        } else {
            $attendance->update_user_id = $user->id;
        }
        $this->attendanceProcessor->process($attendance);
        $attendance->save();
        return $this->sendResponse();
    }

    public function leave()
    {
        $user = auth()->user();
        $stamp = Carbon::now();
        Log::info("[user " . $user->id . "] trying to leave stamp");
        $attendance = $this->stampService->leave($user, $stamp);
        if (!$attendance) {
            Log::error("[user " . $user->id . "] commute stamp error : " . $this->stampService->getError());
            return $this->sendError($this->stampService->getError());
        }
        $this->attendanceProcessor->process($attendance);
        $attendance->save();
        return $this->sendResponse();
    }
    public function getStatus()
    {
        $user = auth()->user();
        $stamp = Carbon::now();

        $commuteEnabled = true;
        $result = $this->stampService->commute($user, $stamp);
        if (!$result) {
            $commuteEnabled = false;
        }

        $leaveEnabled = true;
        $result = $this->stampService->leave($user, $stamp);
        if (!$result) {
            $leaveEnabled = false;
        }
        return $this->sendResponse([
            'commuteEnabled'    =>  $commuteEnabled,
            'leaveEnabled'      =>  $leaveEnabled
        ]);
    }
}
