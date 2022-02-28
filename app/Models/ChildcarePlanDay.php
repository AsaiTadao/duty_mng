<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildcarePlanDay extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'date', 'child_id', 'start_time', 'end_time', 'absent'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

}
