<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OfficeMasterRequest extends FormRequest {

    public function rules() {
        return [
            'number'    => ['required', 'string'],
            'name'      =>  ['required', 'string'],
            'rest_deduction_id'=>  ['required', 'exists:rest_deductions,id'],
            'office_group_id'  =>  ['nullable', 'exists:office_groups,id']
        ];
    }
}
