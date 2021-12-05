<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\PageQuery;
use App\Http\Requests\UserSettingRequest;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Arr;

class UserController extends BaseController
{
    public function get(PageQuery $request)
    {
        $data = $request->validated();
        $users = User::with('setting')->paginate($data['size']);
        // TODO
        return $this->sendResponse($users->items());
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

    // public function updateRole(User $user, )
}
