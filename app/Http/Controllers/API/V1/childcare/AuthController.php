<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Childcare\LoginRequest;
use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
}
