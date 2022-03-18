<?php

namespace App\Http\Resources;

use App\Models\ChildcarePlanDay;
use App\Models\ContactBook;
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
        $date = request()->get('date');
        $noSchedule = false;
        $reason_for_absence_id = $this->reason_for_absence_id;
        $contact_status = ContactBook::STATUS_INCOMPLETE;
        if ($date) {
            $planDay = ChildcarePlanDay::where(['child_id' => $this->id, 'date' => $date])->first();
            // if (!$this->reason_for_absence_id && (!$planDay || $planDay->absent_id || !$planDay->start_time || !$planDay->end_time))
            // {
            //     $noSchedule = true;
            // }
            // if (!$this->reason_for_absence_id && !$this->commuting_time && $planDay && $planDay->absent_id)
            // {
            //     $reason_for_absence_id = $planDay->absent_id;
            // }
            if ($planDay && $planDay->absent_id) {
                $noSchedule = true;
                $reason_for_absence_id = $planDay->absent_id;
            }

            $contactBook = ContactBook::whereDate('date', $date)->where(['child_id' => $this->id])->first();
            if ($contactBook)
            {
                $contact_status = $contactBook->status;
            }
        }
        return [
            'id'            =>  $this->id,
            'class_id'      =>  $this->class_id,
            'name'          =>  $this->name,
            'commuting_time'=>  $this->commuting_time,
            'leave_time'    =>  $this->leave_time,
            'behind_time'   =>  $this->behind_time,
            'leave_early'   =>  $this->leave_early,
            'extension'     =>  $this->extension,
            'reason_for_absence_id'=>   $reason_for_absence_id,
            'no_schedule'   =>  $noSchedule,
            'contact_status'=> $contact_status
        ];
    }
}
