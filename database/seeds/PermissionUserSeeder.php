<?php

use Illuminate\Database\Seeder;
use App\PermissionUser;
use App\Permission;
class PermissionUserSeeder extends Seeder
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
            PermissionUser::create(['permission_id'=>$permission->id,'user_id'=>1]);
            // role - 2 admin
            PermissionUser::create(['permission_id'=>$permission->id,'user_id'=>2]);
        }
    }
}
