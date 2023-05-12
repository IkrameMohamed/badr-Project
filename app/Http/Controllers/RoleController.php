<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest\RoleDelete;
use App\Role;
use App\Permission;
use App\Menu;
use App\PermissionMenu;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Http\Requests\RoleRequest\RoleCreate;
use App\Http\Requests\RoleRequest\RoleUpdate;
use App\Http\Requests\RoleRequest\RoleGetPermission;
use App\Http\Requests\RoleRequest\RoleUpdatePermission;
use App\Http\Requests\RoleRequest\RoleRead;
use App\Http\Requests\RoleRequest\RoleUpdatePermissionForAllUsers;

use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

    public function __construct()
    {
     //   $this->middleware('auth');
    }

    /**
     * index page method
     *
     * @return void
     */
    public function index()
    {
//        if (Gate::allows('roles') == false) {
//            redirect('/')->send();
//        }
        return view('role.index');
    }

    /**
     * @param RoleCreate $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function create(RoleCreate $request)
    {
        Role::create(['name' => $request->name]);
        return $this->returnSuccess('role.create_role_successfully');
    }

    /**
     * @param CustomerUpdate $request
     * @return array|\Illuminate\Http\JsonResponse
     */

    public function update(RoleUpdate $request)
    {
        $roles = Role::find($request->id);
        $roles->name = $request->RoleName;
        $roles->update();
        return $this->returnSuccess('role.update_role_successfully');
    }

    /**
     * @param CustomerDelete $request
     * @return array|\Illuminate\Http\JsonResponse
     */

    public function delete(RoleDelete $request)
    {
        $roles = Role::find($request->id);
        if(!$roles::find($request->id)->users()->get()->toArray())
            $roles->delete();
        return $this->returnSuccess('role.delete_role_successfully');
    }

    public function read(RoleRead $request)
    {
        $roles = new Role;
        if (isset($request->id)) {
            return $this->returnSuccess('role.delete_role_successfully', $roles->find($request->id));
        }
        return $this->returnSuccess('role.ss', $roles->getReguaireRoles());
    }

    public function datatable(Request $request)
    {
        $roles = new Role;
        return Datatables::of($roles::with('users')->whereNotIn('id', [1])->get())
            ->editColumn('created_at', function ($data) {
                return $data->created_at;
            })
            ->make(true);
    }

    public function permissions(RoleGetPermission $request)
    {
        $permissionMenus = Menu::with(['permissions'])->whereNull('parent_id')->get();
        $role = Role::find($request->id);
        $role_permission = $role->permissions()->get();
        foreach ($permissionMenus as $permissionMenu)
            foreach ($permissionMenu->permissions as $permissions)
                $permissions['activated'] = ($role_permission->contains('name', $permissions->name)) ? 1 : 0;
        return $this->returnSuccess('role.get_role_successfully', $permissionMenus);
    }

    public function updatePermissions(RoleUpdatePermission $request)
    {
        $role = Role::findOrFail($request->roleId);
        $permissionMenu = Permission::where('permission_menu_id', $request->menuId)->pluck('id');
        $permissions = Permission::whereIn('name', collect($request->except('menuId', 'roleId'))->keys())->pluck('id');
        $role->permissions()->wherePivotIn('permission_id', $permissionMenu)->sync($permissions);
        $data['roleId'] = $request->roleId;
        return $this->returnSuccess('role.update_role_successfully', $data);
    }

    public function updatePermitionForAllUsers(RoleUpdatePermissionForAllUsers $request)
    {
        $role = Role::findOrFail($request->roleId);
        $role_permissions = $role->permissions()->get();
        $users = User::where('role_id', $request->roleId)->get();
        foreach ($users as $user)
            $user->permissions()->sync($role_permissions);
        return $this->returnSuccess('role.update_role_successfully', $users);
    }

}
