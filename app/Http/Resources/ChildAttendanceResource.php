<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildAttendanceResource extends JsonResource
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
            'id'            =>  $this->id,
            'class_id'      =>  $this->class_id,
            'name'          =>  $this->name,
            'commuting_time'=>  $this->commuting_time,
            'leave_time'    =>  $this->leave_time,
            'behind_time'   =>  $this->behind_time,
            'leave_early'   =>  $this->leave_early,
            'extension'     =>  $this->extension,
            'reason_for_absence_id'=>   $this->reason_for_absence_id
        ];
    }
}
