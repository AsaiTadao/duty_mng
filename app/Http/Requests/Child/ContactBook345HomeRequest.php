<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ContactBook345HomeRequest extends FormRequest {

    public function rules()
    {
        return [
            'date'              =>  ['required', 'date_format:Y-m-d'],
            'contact_0_home'    =>  ['nullable', 'string'],
        ];
    }
}
