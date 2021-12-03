<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\PageQuery;
use App\Models\User;

class UserController extends BaseController
{
    public function get(PageQuery $request)
    {
        $data = $request->validated();
        $users = User::get();
        // TODO
    }
}
