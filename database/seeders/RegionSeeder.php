<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $regions =  [
            '仙台エリア',
            '大阪エリア',
            '九州エリア',
            '沖縄エリア',
        ];
        $i = 1;
        foreach($regions as $regionItem)
        {
            $t = new Region();
            $t->name = $regionItem;
            $t->id = $i;
            $t->save();
            $i++;
        }
    }
}
