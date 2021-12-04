<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkingHourQuery extends FormRequest {

    public function rules() {
        return [
            'office_name'           =>  ['nullable', 'string', 'max:191'],
            'employment_status_id'  =>  ['required', 'exists:employment_statuses,id']
        ];
    }
}
