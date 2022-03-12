<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\LoginRequest;
use App\Models\Child;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $childs = Child::where([
            'email' =>  $data['email']
        ])->get();

        foreach ($childs as $child)
        {
            if (!Hash::check($data['password'], $child->password)) {
                continue;
            }
            return response()->json([
                'success'   =>  true,
                'data'      =>  [
                    'token' =>  $child->createToken('access_token')->plainTextToken,
                    'user'  =>  $child
                ]
            ]);
        }
        if (!Hash::check($data['password'], $child->password)) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  trans('auth.failed')
            ]);
        }

    }
    public function me(Request $request)
    {
        $user = $request->user;
        $user->office;
        $result = $user->toArray();
        $result['office']['certif_type_enabled'] = $user->office->certif_type_enabled;
        return $this->sendResponse($result);
    }
    public function currentOffice(Request $request)
    {
        return $this->sendResponse($request->user->office);
    }
}
