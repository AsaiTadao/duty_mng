<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RegionSeeder::class,
            IndustryGroupSeeder::class,
            OfficeGroupSeeder::class,
            EmploymentStatusSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            OfficeSeeder::class,
            UserSeeder::class,

            UserSettingSeeder::class,
            YearSeeder::class,
            ScheduledWorkingSeeder::class,
            ReasonForVacationSeeder::class,
            ApplicationClassSeeder::class,
            OfficeScheduledWorkingSeeder::class,
            RestDeductionSeeder::class,

            SettingSeeder::class,
            CodeSeeder::class,

            ChildrenClassSeeder::class,
            ChildTypesSeeder::class,
            ChildMoodTypeSeeder::class,
            ReasonForAbsenceSeeder::class,
            ChildSeeder::class,
            BusinessTypeSeeder::class
        ]);
    }
}
