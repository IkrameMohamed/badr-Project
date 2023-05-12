<?php

use Illuminate\Database\Seeder;
use App\PermissionRole;
use App\Permission;
class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionAll = Permission::all();
        /* start sysadmin Role  */
        foreach($permissionAll as $permission ){
            // role - 1 sysadmin
            PermissionRole::create(['permission_id'=>$permission->id,'role_id'=>1]);
            // role - 2 admin
            PermissionRole::create(['permission_id'=>$permission->id,'role_id'=>2]);
        }






    }
}
