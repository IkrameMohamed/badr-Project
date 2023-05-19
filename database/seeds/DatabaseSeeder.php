<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run ()
    {
        $this->call(MenuSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(PermissionUserSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(VisitTypesTableSeeder::class);
        $this->call(DoctorVisitTypeTableSeeder::class);
        $this->call(HousesTableSeeder::class);
        $this->call(BedsTableSeeder::class);
    }
}
