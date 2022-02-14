<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'number'    =>  $this->number,
            'name'      =>  $this->name,
            'gender'    =>  $this->gender,
            'birthday'  =>  $this->birthday,
            'admission_date'    =>  $this->admission_date,
            'exit_date' =>  $this->exit_date,
            'email'     =>  $this->email,
            'type'      =>  $this->child_info->type,
            'company_name'  =>  $this->child_info->company_name,
            'free_of_charge'=>  $this->child_info->free_of_charge,
            'certificate_of_payment'    =>  $this->child_info->certificate_of_payment,
            'certificate_expiration_date'=> $this->child_info->certificate_expiration_date,
            'tax_exempt_household'  =>  $this->child_info->tax_exempt_household,
            'remarks'    =>  $this->child_info->remarks,
        ];
        // return parent::toArray($request);
    }
}
