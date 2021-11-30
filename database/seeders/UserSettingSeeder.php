<?php

namespace Database\Seeders;

use App\Models\UserSetting;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
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
                'user_id'   =>  1,
                'start_date'    =>  '1/1/2010',
                'end_date'      =>  '3/31/2021',
            ],
            [
                'user_id'   =>  1,
                'start_date'    =>  '4/1/2021',
                'end_date'      =>  null,
            ],
            [
                'user_id'   =>  2,
                'start_date'    =>  '1/1/2010',
                'end_date'      =>  '3/31/2021',
            ],
            [
                'user_id'   =>  2,
                'start_date'    =>  '4/1/2021',
                'end_date'      =>  null,
            ],
            [
                'user_id'   =>  3,
                'start_date'    =>  '1/1/2010',
                'end_date'      =>  '3/31/2021',
            ],
            [
                'user_id'   =>  3,
                'start_date'    =>  '4/1/2021',
                'end_date'      =>  null,
            ],
            [
                'user_id'   =>  4,
                'start_date'    =>  '1/1/2010',
                'end_date'      =>  '3/31/2021',
            ],
            [
                'user_id'   =>  4,
                'start_date'    =>  '4/1/2021',
                'end_date'      =>  null,
            ],
            [
                'user_id'   =>  5,
                'start_date'    =>  '1/1/2010',
                'end_date'      =>  '3/31/2021',
            ],
            [
                'user_id'   =>  5,
                'start_date'    =>  '4/1/2021',
                'end_date'      =>  null,
            ],
        ];
        foreach ($data as $item) {
            $userSetting = new UserSetting;
            $userSetting->user_id = $item['user_id'];
            $userSetting->fill($item);
            $userSetting->save();
        }
    }
}
