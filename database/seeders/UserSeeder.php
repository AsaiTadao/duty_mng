<?php

namespace Database\Seeders;

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User;
        $user->fill([
            'name'  =>  'admin001',
            'number'    =>  'admin001',
            'password'  =>  Hash::make('admin001'),
            'role_id'   =>  Roles::ADMIN
        ]);
        $user->id = 1;
        $user->save();

        $user->fill([
            'name'  =>  'mgr001',
            'number'=>  'mgr001',
            'password'=> Hash::make('mgr001'),
            'role_id' => Roles::REGION_MANAGER,
        ]);
        $user->id = 2;
        $user->save();

        $user->fill([
            'name'  =>  'office001',
            'number'=>  'office001',
            'password'=> Hash::make('office001'),
            'role_id' => Roles::OFFICE_MANAGER,
        ]);
        $user->id = 3;
        $user->save();

        $user->fill([
            'name'  =>  'usera001',
            'number'=>  'usera001',
            'password'=> Hash::make('usera001'),
            'role_id'=> Roles::USER_A
        ]);
        $user->id = 4;
        $user->save();

        $user->fill([
            'name'  =>  'userb001',
            'number'=>  'userb001',
            'password'=> Hash::make('userb001'),
            'role_id'=> Roles::USER_B
        ]);
        $user->id = 5;
        $user->save();
    }
}
