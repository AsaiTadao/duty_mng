<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenAttendence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'commuting_time',
        'leave_time',
        'reason_for_absence_id',
        'absence',
        'behind_time',
        'leave_early',
        'extension',
        'child_id',
        'year_id',
        'month',
        'day'
    ];
}
