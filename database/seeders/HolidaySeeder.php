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
    }
}
