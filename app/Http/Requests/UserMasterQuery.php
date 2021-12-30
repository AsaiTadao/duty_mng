<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMasterQuery extends FormRequest {
    public function rules() {
        return [
            'officeName'=> ['nullable'],
            'size'      => ['required', 'numeric'],
            'page'      =>  ['required', 'numeric']
        ];
    }
}
