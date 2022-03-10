<?php

namespace Database\Seeders;

use App\Models\ReasonForAbsence;
use Illuminate\Database\Seeder;

class ReasonForAbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_CORONA,
            'name'  =>  'コロナ欠席',
            'ruby'  =>  'コ'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_PRIVATE,
            'name'  =>  '都合欠席',
            'ruby'  =>  '都'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_KIBIKI,
            'name'  =>  '忌引き',
            'ruby'  =>  '忌'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_SICK,
            'name'  =>  '病欠',
            'ruby'  =>  '病'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_SUSPENSION,
            'name'  =>  '出席停止',
            'ruby'  =>  '出'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_VACATION,
            'name'  =>  '休園',
            'ruby'  =>  '休'
        ]);
        ReasonForAbsence::create([
            'id'    =>  ReasonForAbsence::REASON_HOLIDAY,
            'name'  =>  '祝日',
            'ruby'  =>  '祝'
        ]);
    }
}
