<?php

namespace App\Http\Requests\Child;

use App\Constants\CodeGroups;
use App\Models\Child;
use App\Models\ChildrenClass;
use App\Models\Code;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ChildRequest extends FormRequest {

    protected $childTypesRule = '';

    public function __construct()
    {
        $codes = Code::where(['group' => CodeGroups::CHILD_TYPE])->get()->toArray();
        $this->childTypesRule = implode(',', Arr::pluck($codes, 'key'));
    }

    public function rules() {
        return [
            'number'    => ['required', 'string'],
            'name'      => ['required', 'string'],
            'gender'    => ['required', 'in:' . Child::GENDER_MALE . ',' . Child::GENDER_FEMALE],
            'birthday'  => ['required', 'date_format:Y-m-d'],
            'admission_date'  => ['required', 'date_format:Y-m-d'],
            'exit_date'  => ['required', 'date_format:Y-m-d'],
            'email'     =>  ['required', 'email'],
            'password'  =>  ['nullable'],
            'type'      =>  ['nullable', 'in:' . $this->childTypesRule],
            'company_name' => ['required', 'string'],
            'free_of_charge'=>  ['nullable', 'in:0,1'],
            'certificate_of_payment'=> ['nullable', 'in:0,1'],
            'certificate_expiration_date'=> ['nullable', 'date_format:Y-m-d'],
            'tax_exempt_household'  =>  ['nullable', 'in:0,1'],
            'class_id'   =>  ['nullable', 'in:' . ChildrenClass::AGE_0 . ',' . ChildrenClass::AGE_1 . ',' . ChildrenClass::AGE_2 . ',' . ChildrenClass::AGE_3 . ',' . ChildrenClass::AGE_4 . ',' . ChildrenClass::AGE_5 ],
            'remarks'    =>  ['nullable', 'string'],
        ];
    }
}
