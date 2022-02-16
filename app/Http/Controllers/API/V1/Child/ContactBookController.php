<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\ContactBook0HomeRequest;
use App\Http\Requests\Child\ContactBook0SchoolRequest;
use App\Http\Requests\Child\ContactBook12HomeRequest;
use App\Http\Requests\Child\ContactBook12SchoolRequest;
use App\Http\Requests\Child\ContactBook345HomeRequest;
use App\Http\Requests\Child\ContactBook345SchoolRequest;
use App\Models\Child;
use App\Models\ContactBook;

class ContactBookController extends BaseController
{
    public function schoolSave0(Child $child, ContactBook0SchoolRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];

        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

    public function schoolSave12(Child $child, ContactBook12SchoolRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];
        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

    public function schoolSave345(Child $child, ContactBook345SchoolRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];
        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

    public function homeSave0(Child $child, ContactBook0HomeRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];

        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

    public function homeSave12(Child $child, ContactBook12HomeRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];
        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

    public function homeSave345(Child $child, ContactBook345HomeRequest $request)
    {
        $data = $request->validated();
        $date = $data['date'];
        $contactBook = ContactBook::where(['child_id' => $child->id, 'date' => $date])->first();
        if (!$contactBook)
        {
            $contactBook = new ContactBook(['child_id' => $child->id, 'date' => $date]);
        }
        $contactBook->fill($data);
        $contactBook->save();
        return $this->sendResponse($contactBook);
    }

}
