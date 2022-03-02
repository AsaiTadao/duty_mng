<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Holiday::create([
            'date'  =>  '2022-02-14',
            'name'  =>  "Valentine's day"
        ]);
        Holiday::create([
            'date'  =>  '2022-03-14',
            'name'  =>  "Chocolate day"
        ]);
        Holiday::create([
            'date'  =>  '2022-04-14',
            'name'  =>  "Wine day"
        ]);

        Holiday::create([
            'date'  =>  '2022-01-01',
            'name'  =>  "New Year's Day"
        ]);
    }
}
