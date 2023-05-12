<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* start manage_users  */
        Permission::create(['name'  => 'all_users','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'add_users','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'update_users','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'delete_users','permission_menu_id'=>'1']);

        Permission::create(['name'  => 'roles','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'add_roles','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'update_roles','permission_menu_id'=>'1']);
        Permission::create(['name'  => 'delete_roles','permission_menu_id'=>'1']);

        Permission::create(['name'  => 'appointments','permission_menu_id'=>'4']);
        Permission::create(['name'  => 'add_appointments','permission_menu_id'=>'4']);
        Permission::create(['name'  => 'delete_appointments','permission_menu_id'=>'4']);
        Permission::create(['name'  => 'checked_appointments','permission_menu_id'=>'4']);
        /* end manage_forms  */
        /* start manage_settings  */
        Permission::create(['name'  => 'settings','permission_menu_id'=>'5']);
        Permission::create(['name'  => 'update_settings','permission_menu_id'=>'5']);
        /* end manage_settings  */

        Permission::create(['name'  => 'translations','permission_menu_id'=>'6']);

    }
}
