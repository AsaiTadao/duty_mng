<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $user = User::find(1);
        $user->function = "";
    }
}
