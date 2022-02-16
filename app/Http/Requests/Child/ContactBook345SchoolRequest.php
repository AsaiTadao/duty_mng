<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ContactBook345SchoolRequest extends FormRequest {

    public function rules()
    {
        return [
            'date'              =>  ['required', 'date_format:Y-m-d'],
            'weather'           =>  ['nullable', 'string'],
            'contact_0_school'  =>  ['required', 'string']
        ];
    }
}
