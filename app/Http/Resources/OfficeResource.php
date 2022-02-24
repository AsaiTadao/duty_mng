<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $office_info = $this->office_information;
        return [
            "id"    =>  $this->id,
            "region_id" =>  $this->region_id,
            "industry_group_id" =>  $this->industry_group_id,
            "office_group_id"   =>  $this->office_group_id,
            "rest_deduction_id" =>  $this->rest_deduction_id,
            "name"  =>  $this->name,
            "number"    =>  $this->number,
            "address"   =>  $this->address,
            "tel"   =>  $this->tel,
            "deleted_at"=> null,
            "created_at"    =>  $this->created_at,
            "updated_at"    =>  $this->updated_at,
            "create_user_id"    =>  $this->create_user_id,
            "update_user_id"    =>  $this->update_user_id,
            "type" => $this->type,
            "is_headquarter"    =>  $this->is_headquarter,
            "is_nursery"    => $this->is_nursery,

            'open_time' =>  $office_info ? $office_info->open_time : '',
            'close_time'    =>  $office_info ? $office_info->close_time : '',
            'capacity'  =>  $office_info ? $office_info->capacity : '',
            'appropriate_number_0'  =>  $office_info ? $office_info->appropriate_number_0 : '',
            'appropriate_number_1'  =>  $office_info ? $office_info->appropriate_number_1 : '',
            'appropriate_number_2'  =>  $office_info ? $office_info->appropriate_number_2 : '',
            'appropriate_number_3'  =>  $office_info ? $office_info->appropriate_number_3 : '',
            'appropriate_number_4'  =>  $office_info ? $office_info->appropriate_number_4 : '',
            'appropriate_number_5'  =>  $office_info ? $office_info->appropriate_number_5 : '',
            'business_type_id'  =>  $office_info ? $office_info->business_type_id : '',
        ];
        // return parent::toArray($request);
    }
}
