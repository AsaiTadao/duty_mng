<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ContactBook345SchoolRequest extends FormRequest {

    public function rules()
    {
        return [
            'date'              =>  ['required', 'date_format:Y-m-d'],
            'weather'           =>  ['required', 'string'],
            'nurse_name'        =>  ['nullable', 'string'],
            'guardian'          =>  ['nullable', 'string'],
            'contact_0_school'  =>  ['nullable', 'string'],
            'status'            =>  ['nullable', 'in:' . ContactBook::STATUS_TEMPORARY . ',' . ContactBook::STATUS_COMPLETED],
        ];
    }
}
