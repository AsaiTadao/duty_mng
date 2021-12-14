<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkStatusCreateRequest extends FormRequest {

    public function rules() {
        return [
            'user_id' =>  ['required', 'exists:users,id'],
            'date'      =>  ['required', 'date_format:Y-m-d'],
            'commuting_time_1' => ['nullable'],
            'leave_time_1'     => ['nullable'],
            'commuting_time_2' => ['nullable'],
            'leave_time_2'     => ['nullable']
        ];
    }
}
