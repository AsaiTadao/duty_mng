<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftPlan extends Model
{
    use HasFactory;

    protected $dates = ['date'];

    protected $fillable = [
        'day_of_week',
        'date',
        'user_id',
        'working_hours_id',
        'start_time',
        'end_time',
        'rest_start_time',
        'rest_end_time',
        'vacation_reason_id',
    ];
}
