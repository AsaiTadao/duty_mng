<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkStatusUpdateRequest extends FormRequest {

    public function rules() {
        return [
            'commuting_time_1' => ['nullable'],
            'leave_time_1'     => ['nullable'],
            'commuting_time_2' => ['nullable'],
            'leave_time_2'     => ['nullable']
        ];
    }
}
