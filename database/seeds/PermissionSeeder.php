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

        Permission::create(['name'  => 'reservations','permission_menu_id'=>'5']);
        Permission::create(['name'  => 'add_reservations','permission_menu_id'=>'5']);
        Permission::create(['name'  => 'delete_reservations','permission_menu_id'=>'5']);
        /* end manage_forms  */
        Permission::create(['name'  => 'product','permission_menu_id'=>'6']);
        /* end manage_forms  */
        Permission::create(['name'  => 'add_product','permission_menu_id'=>'7']);
        /* start manage_settings  */
        Permission::create(['name'  => 'list_demande','permission_menu_id'=>'8']);
        /* start manage_settings  */
        Permission::create(['name'  => 'list_product','permission_menu_id'=>'9']);
        /* start manage_settings  */

        Permission::create(['name'  => 'list_type','permission_menu_id'=>'10']);
        Permission::create(['name'  => 'add_type','permission_menu_id'=>'11']);



        Permission::create(['name'  => 'settings','permission_menu_id'=>'12']);
        Permission::create(['name'  => 'update_settings','permission_menu_id'=>'12']);
        /* end manage_settings  */

        Permission::create(['name'  => 'translations','permission_menu_id'=>'13']);

    }
}
