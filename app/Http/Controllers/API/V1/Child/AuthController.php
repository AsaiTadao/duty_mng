<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\LoginRequest;
use App\Http\Resources\OfficeResource;
use App\Models\Child;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

            if ($data['password'] != Crypt::decryptString($child->password)) {
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
        return response()->json([
            'success'   =>  false,
            'message'   =>  trans('auth.failed')
        ]);

    }
    public function me(Request $request)
    {
        $user = $request->user;
        $user->office;
        $result = $user->toArray();
        if ($user instanceof User && $user->office) {
            $result['office'] = new OfficeResource($user->office);
        }

        $result['office']['certif_type_enabled'] = $user->office->certif_type_enabled;
        return $this->sendResponse($result);
    }
    public function currentOffice(Request $request)
    {
        return $this->sendResponse($request->user->office);
    }
}
