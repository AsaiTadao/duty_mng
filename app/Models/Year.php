<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Year extends Model
{
    use HasFactory;

    protected $hidden = [
        'create_user_id',
        'update_user_id'
    ];

    public static function diff($targetDate) {
        // 年度判定補正
        $target_year = Year::where([
            ['start', '<=', date('Ym',  strtotime($targetDate)) ],
            ['end', '>=', date('Ym',  strtotime($targetDate))]
        ])->first();
        $now_year = Year::where([
            ['start', '<=', date('Ym',  strtotime(Carbon::now())) ],
            ['end', '>=', date('Ym',  strtotime(Carbon::now()))]
        ])->first();

        $diff = ($target_year->start - $now_year->start)/100;
        return $diff;
    }
}
