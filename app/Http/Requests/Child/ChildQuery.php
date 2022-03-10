<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ChildQuery extends FormRequest {

    public function rules() {
        return [
            'query'             => ['nullable', 'string'],
            'plan_registered'   => ['nullable', 'in:0,1,2'],
            'including_exited'  => ['nullable', 'boolean'],
            'class_id'          => ['nullable', 'exists:children_classes,id']
        ];
    }
}
