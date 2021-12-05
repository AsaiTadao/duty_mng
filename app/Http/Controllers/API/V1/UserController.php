<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\PageQuery;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests\UserSettingRequest;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Arr;

class UserController extends BaseController
{
    public function get(PageQuery $request)
    {
        $data = $request->validated();
        $users = User::with('setting', 'office', 'office.region')->paginate($data['size'])->items();
        // TODO
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
                $item['office'] = [
                    'id'    =>  $item['office']['id'],
                    'name'  =>  $item['office']['name']
                ];
            }
            $response[] = $item;
        }
        return $this->sendResponse($response);
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
}
