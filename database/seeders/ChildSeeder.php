<?php

namespace Database\Seeders;

use App\Models\Child;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $count = 1;
        for ($i = 1; $i < 6; $i++)
        {
            for ($j = 0; $j < 10; $j++)
            {
                $name = 'child' . sprintf('%03d', $count);
                $child = new Child();
                $child->fill([
                    'name'  =>  $name,
                    'number'=>  $name,
                    'password'  =>  Hash::make($name),
                    'office_id' =>  $i + 1,
                    'class_id'  =>  ($j % 6) + 1

                ]);
                $child->id = $count;
                $child->save();
                $count++;
            }
        }
    }
}
