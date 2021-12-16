<?php

namespace App\Services;

use App\Models\Attendance;
use App\Services\Processors\AttendancePreProcessor;
use App\Services\Processors\AttendanceApplicationProcessor;

/**
 * calculate behind time, leave early based on the commuting and leave time
 */
class AttendancePipleline
{
    protected $error;

    protected $attendancePreProcessor;
    protected $attendanceApplicationProcessor;

    public function __construct(
        AttendancePreProcessor $attendancePreProcessor,
        AttendanceApplicationProcessor $attendanceApplicationProcessor
    )
    {
        $this->attendancePreProcessor = $attendancePreProcessor;
        $this->attendanceApplicationProcessor = $attendanceApplicationProcessor;
    }

    public function process(Attendance &$attendance)
    {
        $this->attendancePreProcessor->process($attendance);
        $this->attendanceApplicationProcessor->process($attendance);
    }
}
