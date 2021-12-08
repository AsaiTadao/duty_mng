<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest {

    public function rules() {
        return [
            'user_id'          => ['required', 'exists:users,id'],
            'date'             => ['required', 'date_format:Y-m-d'],
            'shifts'           => ['nullable', 'array'],
            'shifts.*.id'      => ['nullable', 'exists:shift_plans,id'],
            'shifts.*.working_hours_id'=> ['nullable', 'exists:working_hours,id'],
            'shifts.*.start_time'=> ['nullable', 'date_format:H:i'],
            'shifts.*.end_time' =>  ['nullable', 'date_format:H:i'],
            'shifts.*.rest_start_time'=> ['nullable', 'date_format:H:i'],
            'shifts.*.rest_end_time'=>  ['nullable', 'date_format:H:i'],
            'shifts.*.vacation_reason_id'=> ['nullable', 'exists:reason_for_vacations,id'],
        ];
    }
}
