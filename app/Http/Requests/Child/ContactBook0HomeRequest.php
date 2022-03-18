<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ContactBook0HomeRequest extends FormRequest {

    public function rules() {
        return [
            'date'      =>  ['required', 'date_format:Y-m-d'],
            'weather'   => ['nullable', 'string'],
            'mood'      => ['nullable', 'in:1,2,3'],
            'pick_up_person'  =>  ['nullable'],
            'pick_up_time'    =>  ['nullable', 'date_format:H:i'],
            'guardian'          =>  ['nullable', 'string'],
            'sleep_0100_home' =>  ['nullable', 'boolean'],
            'sleep_0130_home' =>  ['nullable', 'boolean'],
            'sleep_0200_home' =>  ['nullable', 'boolean'],
            'sleep_0230_home' =>  ['nullable', 'boolean'],
            'sleep_0300_home' =>  ['nullable', 'boolean'],
            'sleep_0330_home' =>  ['nullable', 'boolean'],
            'sleep_0400_home' =>  ['nullable', 'boolean'],
            'sleep_0430_home' =>  ['nullable', 'boolean'],
            'sleep_0500_home' =>  ['nullable', 'boolean'],
            'sleep_0530_home' =>  ['nullable', 'boolean'],
            'sleep_0600_home' =>  ['nullable', 'boolean'],
            'sleep_0630_home' =>  ['nullable', 'boolean'],
            'sleep_0700_home' =>  ['nullable', 'boolean'],
            'sleep_0730_home' =>  ['nullable', 'boolean'],
            'sleep_0800_home' =>  ['nullable', 'boolean'],
            'sleep_0830_home' =>  ['nullable', 'boolean'],
            'sleep_0900_home' =>  ['nullable', 'boolean'],
            'sleep_0930_home' =>  ['nullable', 'boolean'],
            'sleep_1000_home' =>  ['nullable', 'boolean'],
            'sleep_1030_home' =>  ['nullable', 'boolean'],
            'sleep_1100_home' =>  ['nullable', 'boolean'],
            'sleep_1130_home' =>  ['nullable', 'boolean'],
            'sleep_1200_home' =>  ['nullable', 'boolean'],
            'sleep_1230_home' =>  ['nullable', 'boolean'],
            'sleep_0800_home' =>  ['nullable', 'boolean'],
            'sleep_0830_home' =>  ['nullable', 'boolean'],
            'sleep_0900_home' =>  ['nullable', 'boolean'],
            'sleep_0930_home' =>  ['nullable', 'boolean'],
            'sleep_1000_home' =>  ['nullable', 'boolean'],
            'sleep_1030_home' =>  ['nullable', 'boolean'],
            'sleep_1100_home' =>  ['nullable', 'boolean'],
            'sleep_1130_home' =>  ['nullable', 'boolean'],
            'sleep_1200_home' =>  ['nullable', 'boolean'],
            'sleep_1230_home' =>  ['nullable', 'boolean'],
            'sleep_1300_home' =>  ['nullable', 'boolean'],
            'sleep_1330_home' =>  ['nullable', 'boolean'],
            'sleep_1400_home' =>  ['nullable', 'boolean'],
            'sleep_1430_home' =>  ['nullable', 'boolean'],
            'sleep_1500_home' =>  ['nullable', 'boolean'],
            'sleep_1530_home' =>  ['nullable', 'boolean'],
            'sleep_1600_home' =>  ['nullable', 'boolean'],
            'sleep_1630_home' =>  ['nullable', 'boolean'],
            'sleep_1700_home' =>  ['nullable', 'boolean'],
            'sleep_1730_home' =>  ['nullable', 'boolean'],
            'sleep_1800_home' =>  ['nullable', 'boolean'],
            'sleep_1830_home' =>  ['nullable', 'boolean'],
            'sleep_1900_home' =>  ['nullable', 'boolean'],
            'sleep_1930_home' =>  ['nullable', 'boolean'],
            'sleep_2000_home' =>  ['nullable', 'boolean'],
            'sleep_2030_home' =>  ['nullable', 'boolean'],
            'sleep_2100_home' =>  ['nullable', 'boolean'],
            'sleep_2130_home' =>  ['nullable', 'boolean'],
            'sleep_2200_home' =>  ['nullable', 'boolean'],
            'sleep_2230_home' =>  ['nullable', 'boolean'],
            'sleep_2300_home' =>  ['nullable', 'boolean'],
            'sleep_2330_home' =>  ['nullable', 'boolean'],
            'sleep_2400_home' =>  ['nullable', 'boolean'],
            'sleep_2430_home' =>  ['nullable', 'boolean'],
            'temperature_01_home' =>  ['nullable', 'numeric'],
            'temperature_02_home' =>  ['nullable', 'numeric'],
            'temperature_03_home' =>  ['nullable', 'numeric'],
            'temperature_04_home' =>  ['nullable', 'numeric'],
            'temperature_05_home' =>  ['nullable', 'numeric'],
            'temperature_06_home' =>  ['nullable', 'numeric'],
            'temperature_07_home' =>  ['nullable', 'numeric'],
            'temperature_08_home' =>  ['nullable', 'numeric'],
            'temperature_09_home' =>  ['nullable', 'numeric'],
            'temperature_10_home' =>  ['nullable', 'numeric'],
            'temperature_11_home' =>  ['nullable', 'numeric'],
            'temperature_12_home' =>  ['nullable', 'numeric'],
            'temperature_13_home' =>  ['nullable', 'numeric'],
            'temperature_14_home' =>  ['nullable', 'numeric'],
            'temperature_15_home' =>  ['nullable', 'numeric'],
            'temperature_16_home' =>  ['nullable', 'numeric'],
            'temperature_17_home' =>  ['nullable', 'numeric'],
            'temperature_18_home' =>  ['nullable', 'numeric'],
            'temperature_19_home' =>  ['nullable', 'numeric'],
            'temperature_20_home' =>  ['nullable', 'numeric'],
            'temperature_21_home' =>  ['nullable', 'numeric'],
            'temperature_22_home' =>  ['nullable', 'numeric'],
            'temperature_23_home' =>  ['nullable', 'numeric'],
            'temperature_24_home' =>  ['nullable', 'numeric'],
            'defecation_1_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_2_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_3_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_4_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_5_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_6_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_7_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_8_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_9_home'   =>  ['nullable', 'in:0,1,2,3'],
            'defecation_10_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_11_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_12_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_13_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_14_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_15_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_16_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_17_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_18_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_19_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_20_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_21_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_22_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_23_home'  =>  ['nullable', 'in:0,1,2,3'],
            'defecation_24_home'  =>  ['nullable', 'in:0,1,2,3'],
            'meal_1_home'     =>  ['nullable', 'string'],
            'meal_2_home'     =>  ['nullable', 'string'],
            'meal_3_home'     =>  ['nullable', 'string'],
            'meal_4_home'     =>  ['nullable', 'string'],
            'meal_5_home'     =>  ['nullable', 'string'],
            'meal_6_home'     =>  ['nullable', 'string'],
            'meal_7_home'     =>  ['nullable', 'string'],
            'meal_8_home'     =>  ['nullable', 'string'],
            'meal_9_home'     =>  ['nullable', 'string'],
            'meal_10_home'    =>  ['nullable', 'string'],
            'meal_11_home'    =>  ['nullable', 'string'],
            'meal_12_home'    =>  ['nullable', 'string'],
            'meal_13_home'    =>  ['nullable', 'string'],
            'meal_14_home'    =>  ['nullable', 'string'],
            'meal_15_home'    =>  ['nullable', 'string'],
            'meal_16_home'    =>  ['nullable', 'string'],
            'meal_17_home'    =>  ['nullable', 'string'],
            'meal_18_home'    =>  ['nullable', 'string'],
            'meal_19_home'    =>  ['nullable', 'string'],
            'meal_20_home'    =>  ['nullable', 'string'],
            'meal_21_home'    =>  ['nullable', 'string'],
            'meal_22_home'    =>  ['nullable', 'string'],
            'meal_23_home'    =>  ['nullable', 'string'],
            'meal_24_home'    =>  ['nullable', 'string'],
            'state_0_home'    =>  ['nullable', 'string'],
            'contact_0_home'  =>  ['nullable', 'string'],

        ];
    }
}
