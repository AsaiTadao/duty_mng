<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    const TYPE_COMMUTE = "commute";
    const TYPE_LEAVE = "leave";

    protected $dates = [
        'commuting_time_1',
        'commuting_time_2',
        'commuting_time_3',
        'leave_time_1',
        'leave_time_2',
        'leave_time_3',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift1()
    {
        return $this->belongsTo(ShiftPlan::class, 'shift_1_id');
    }
    public function shift2()
    {
        return $this->belongsTo(ShiftPlan::class, 'shift_2_id');
    }
    public function shift3()
    {
        return $this->belongsTo(ShiftPlan::class, 'shift_3_id');
    }
}
