<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\ChildQuery;
use App\Http\Requests\Child\ChildRequest;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use App\Models\ChildInformation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChildController extends BaseController
{
    public function register(ChildRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        if (empty($data['password'])) {
            return response()->json(['message' => 'Password is required'], 422);
        }
        $child = Child::where(['email' => $data['email']])->first();
        if ($child) {
            return response()->json(['message' => trans('This email is already registered')]);
        }

        $data['password'] = Hash::make($data['password']);
        $child = new Child($data);
        $child->office_id = $user->office_id;
        $child->save();

        $childInfo = new ChildInformation($data);
        $child->child_info()->save($childInfo);
        return new ChildResource($child);
    }

    public function update(Child $child, ChildRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else if (isset($data['password'])) {
            unset($data['password']);
        }
        $existing = Child::where(['email' => $data['email']])->first();
        if ($existing && $existing->id !== $child->id) {
            return response()->json(['message' => trans('This email is already registered')]);
        }
        $child->fill($data);
        $child->save();

        $childInfo = $child->child_info;
        $childInfo->fill($data);
        $childInfo->save();
        $child->refresh();

        return new ChildResource($child);
    }
    public function retrieve(Child $child)
    {
        return new ChildResource($child);
    }
    public function delete(Child $child)
    {
        $child->delete();
        return response()->json();
    }
    public function list(ChildQuery $request)
    {
        $user = auth()->user();

        $data = $request->validated();

        $qb = Child::where(['office_id' => $user->office_id]);
        if (!empty($data['query']))
        {
            $search = $data['query'];
            $qb->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('number', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        // TODO search plan_registered
        return response()->json($qb->get());
    }
}
