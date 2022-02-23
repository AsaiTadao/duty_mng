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
        $child = Child::where([
            'email' =>  $data['email']
        ])->first();

        if (!$child) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  trans('auth.user_not_found')
            ]);
        }

        if (!Hash::check($data['password'], $child->password)) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  trans('auth.failed')
            ]);
        }
        return response()->json([
            'success'   =>  true,
            'data'      =>  [
                'token' =>  $child->createToken('access_token')->plainTextToken,
                'user'  =>  $child
            ]
        ]);
    }
    public function me(Request $request)
    {
        $user = $request->user;
        $user->office;
        return $this->sendResponse($request->user);
    }
    public function currentOffice(Request $request)
    {
        return $this->sendResponse($request->user->office);
    }
}
