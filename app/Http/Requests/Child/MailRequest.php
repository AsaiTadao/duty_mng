<?php

namespace App\Http\Requests\Child;

use App\Models\MailHistory;
use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest {

    public function rules() {
        return [
            'subject'       =>  ['required', 'string'],
            'content'       =>  ['required', 'string'],
            'children_class_id'=>   ['nullable', 'exists:children_classes,id'],
            'type'          =>  ['required', 'in:' . MailHistory::TYPE_NORMAL . ',' . MailHistory::TYPE_URGENT],
        ];
    }
}
