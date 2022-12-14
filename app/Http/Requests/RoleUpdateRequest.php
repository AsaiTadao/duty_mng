<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest {

    public function rules() {
        return [
            'role_id'   =>  ['required', 'exists:roles,id'],
        ];
    }
}
