<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\ChildcareDiaryQuery;
use App\Http\Requests\Child\ChildcareDiaryRequest;
use App\Models\ChildcareDiary;

class ChildcareDiaryController extends BaseController
{
    public function save(ChildcareDiaryRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        $diary = ChildcareDiary::where([
            'office_id'         =>  $user->office_id,
            'children_class_id' => $data['children_class_id'],
            'date'              =>  $data['date']
        ])->first();

        if (!$diary)
        {
            $diary = new ChildcareDiary(['office_id' => $user->office_id]);
        }
        $diary->fill($data);
        $diary->save();

        return $this->sendResponse($diary);
    }
    public function retrieve(ChildcareDiaryQuery $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $diary = ChildcareDiary::where([
            'office_id'     =>  $user->office_id,
            'children_class_id'=> $data['children_class_id'],
            'date'          =>  $data['date']
        ])->first();

        if (!$diary)
        {
            $diary = new ChildcareDiary();
        }
        return $this->sendResponse($diary);
    }
}
