<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Roles;
use App\Http\Requests\PageQuery;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSettingRequest;
use App\Models\Office;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function get(PageQuery $request)
    {
        $data = $request->validated();
        $users = User::with('setting', 'office', 'office.region', 'office.group')->orderByDesc('created_at')->paginate($data['size'])->items();
        $response = [];
        foreach($users as $user)
        {
            $item = $user->toArray();
            if (!empty($item['office']))
            {
                if (!empty($item['office']['region']))
                {
                    $item['region'] = [
                        'id'    =>  $item['office']['region']['id'],
                        'name'  =>  $item['office']['region']['name']
                    ];
                }
                if (!empty($item['office']['group']))
                {
                    $item['office_group'] = [
                        'id'    =>  $item['office']['group']['id'],
                        'name'  =>  $item['office']['group']['name'],
                    ];
                }
                $item['office'] = [
                    'id'    =>  $item['office']['id'],
                    'name'  =>  $item['office']['name']
                ];
            }
            if (empty($item['setting']))
            {
                $item['setting'] = [
                    'overtime_pay'      =>  null,
                    'salary_deduction'  =>  null,
                    'application_deadline'  =>  null,
                ];
            }
            $response[] = $item;
        }
        return $this->sendResponse($response);
    }
    public function create(UserRequest $request)
    {
        $currentUser = auth()->user();
        $data = $request->validated();
        $user = new User();
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->create_user_id = $currentUser->id;

        if (!empty($data['role_id']))
        {
            $user->role_id = $data['role_id'];
        } else {
            $user->role_id = Roles::USER_B;
        }
        $user->save();

        $setting = new UserSetting();
        $setting->user_id = $user->id;
        $setting->create_user_id = $currentUser->id;
        $setting->save();

        return $this->sendResponse($user);
    }
    public function update(User $user, UserRequest $request)
    {
        $currentUser = auth()->user();
        $data = $request->validated();
        $user->fill($data);
        if (!empty($data['password']))
        {
            $user->password = Hash::make($data['password']);
        }
        $user->update_user_id = $currentUser->id;
        $user->save();
        return $this->sendResponse($user);
    }
    public function delete(User $user)
    {
        $user->delete();
        return $this->sendResponse();
    }

    public function updateSetting(User $user, UserSettingRequest $request)
    {
        $currentUser = auth()->user();

        $data = $request->validated();
        $setting = $user->setting;
        if (!$setting)
        {
            $setting = new UserSetting;
            $setting->user_id = $user->id;
            $setting->create_user_id = $currentUser->id;
        } else {
            $setting->update_user_id = $currentUser->id;
        }
        if (!empty($data['overtime_pay']))
        {
            $setting->overtime_pay = $data['overtime_pay'];
        }
        if (!empty($data['salary_deduction']))
        {
            $setting->salary_deduction = $data['salary_deduction'];
        }
        if (!empty($data['application_deadline']))
        {
            $setting->application_deadline = $data['application_deadline'];
        }
        $setting->save();
        return $this->sendResponse($setting);
    }

    public function updateRole(User $user, RoleUpdateRequest $request)
    {
        $data = $request->validated();
        $role_id = $data['role_id'];
        $user->role_id = $role_id;
        $user->save();
        return $this->sendResponse($user);
    }

    public function getUsers(Office $office)
    {
        if (!Gate::allows('get-office-users', $office)) {
            abort(403);
        }
        return $this->sendResponse($office->users);
    }
}
