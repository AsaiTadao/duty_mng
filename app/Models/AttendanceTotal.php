<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTotal extends Model
{
    use HasFactory;

    protected $fillable = [
        'working_days',
        'total_working_days',
        'actual_working_hours_weekdays',
        'actual_working_hours_saturday',
        'scheduled_working_hours_a',
        'scheduled_working_hours_b',
        'excess_and_deficiency_time',
        'overtime_hours_weekdays',
        'overtime_hours_saturday',
        'overtime_hours_statutory',
        'overtime_hours_non_statutory',
        'midnight_overtime',
        'behind_time',
        'leave_early',
        'off_shift_working_hours',
        'substitute_holiday_time',
        'consecutive_working_hours',
        'annual_paid_time',
        'annual_paid_days',
        'special_paid_time',
        'special_paid_days',
        'special_unpaid_time',
        'special_unpaid_days',
        'other_unpaid_time',
        'other_unpaid_days',
        'absence_days',
    ];
}
