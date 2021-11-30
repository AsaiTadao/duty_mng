<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where([
            'number'    =>  $data['number']
        ])->first();

        if (!$user) {
            return response()->json([
                'success'   =>  false,
                'message'   =>  trans('auth.user_not_found')
            ]);
        }

        if (!Hash::check($data['password'], $user->password))
        {
            return response()->json([
                'success'   =>  false,
                'message'   =>  trans('auth.failed')
            ]);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  [
                'token' =>  $user->createToken('access_token')->plainTextToken,
                'user'  =>  $user
            ]
        ]);
    }
    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ]);
    }
}
