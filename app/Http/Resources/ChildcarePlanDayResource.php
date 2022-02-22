<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ChildcarePlanDayResource extends JsonResource
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
            'date'  =>  $this->date->format('Y-m-d'),
            'start_time'    =>  $this->start_time,
            'end_time'      =>  $this->end_time,
            'absent'        =>  $this->absent,
            'day'           =>  $this->date->day
        ];
    }
}
