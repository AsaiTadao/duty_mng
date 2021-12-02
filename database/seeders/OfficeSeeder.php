<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\RestDeduction;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name'  =>  '天王寺ひよこ園',
                'region_id'=>   2,
                'industry_group_id' =>  2,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_1
            ],
            [
                'name'  =>  '日本橋ひよこ園',
                'region_id'=>   2,
                'industry_group_id' =>  2,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_2
            ],
            [
                'name'  =>  '日本橋園',
                'region_id'=>   2,
                'industry_group_id' =>  2,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_1
            ],
            [
                'name'  =>  '梅田あひる園',
                'region_id'=>   2,
                'industry_group_id' =>  2,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_1
            ],
            [
                'name'  =>  '福岡かえる園',
                'region_id'=>   3,
                'industry_group_id' =>  2,
                'office_group_id'   =>  3,
                'rest_deduction_id' =>  RestDeduction::TYPE_2
            ],
            [
                'name'  =>  '福岡すずめ園',
                'region_id'=>   3,
                'industry_group_id' =>  2,
                'office_group_id'   =>  3,
                'rest_deduction_id' =>  RestDeduction::TYPE_1
            ],
            [
                'name'  =>  '新大阪支店',
                'region_id'=>   2,
                'industry_group_id' =>  1,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_2
            ],
            [
                'name'  =>  '心斎橋支店',
                'region_id'=>   2,
                'industry_group_id' =>  1,
                'office_group_id'   =>  2,
                'rest_deduction_id' =>  RestDeduction::TYPE_1
            ],
            [
                'name'  =>  '沖縄本部',
                'region_id'=>   4,
                'industry_group_id' =>  1,
                'office_group_id'   =>  3,
                'rest_deduction_id' =>  RestDeduction::TYPE_2
            ],
        ];
        $i = 1;
        foreach($data as $item)
        {
            $t = new Office();
            $t->fill($item);
            $t->id = $i;
            $t->save();
            $i++;
        }
    }
}
