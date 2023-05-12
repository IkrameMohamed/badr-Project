<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Menu;
use App\Role;
use App\User;
use App\Sessions;
use App\ReceiptFieldRelation;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest\UserDelete;
use App\Http\Requests\UserRequest\UserCreate;
use App\Http\Requests\UserRequest\UserActivate;
use App\Http\Requests\UserRequest\UserUpdate;
use App\Http\Requests\UserRequest\UserGetPermission;
use App\Http\Requests\UserRequest\UserUpdatePermissions;
use App\Http\Requests\UserRequest\UserUpdateRole;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::allows('all_users') == false) {
            redirect('/')->send();
        }

        return view('user.index');
    }

    /**
     * creat user
     * @param UserCreate $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function create(UserCreate $request)
    {

        $user = new User;
        $user->name = $request->UserName;
        $user->email = $request->UserEmail;
        $user->password = \Hash::make($request->UserPassword);
        $user->role_id = $request->allRoles;
        $user->save();
        $path = public_path('assets/files/users/' . $user->id);
        $this->updateUserRole($request->allRoles, $user->id);

        $this->createDirecrotory($path);
        if ($file = $request->file('UserImage')) {
            $file->move($path, 'profiel.jpg');
        } else {
            $this->moveDefaultImageTo($path . '/profiel.jpg');
        }
        return $this->returnSuccess('user.create_user_succesfuly');
    }

    /**
     * delete user by id
     * @param UserDelete $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function delete(UserDelete $request)
    {

        $user = User::find($request->id);
        $user->delete();
        return $this->returnSuccess('user.delete_user_succesfuly');
    }

    /**
     * get users datatables
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $users = new User;
        return Datatables::of($users->getReguaireUsers())
            ->editColumn('created_at', function ($data) {
                return $data->created_at;
            })
            ->make(true);
    }

    /**
     * change user status
     * @param UserActivate $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function activate(UserActivate $request)
    {
        $user = User::find($request->id);
        $user->active = $request->status;
        $user->update();
        $messageResponse = ($request->status == 1) ? 'user.activate_user_succesfuly' : 'user.uncativate_user_succesfuly';
        return $this->returnSuccess($messageResponse);
    }

    /**
     * @param CustomerUpdate $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */

    public function update(UserUpdate $request)
    {
        $user = User::find($request->id);
        $user->name = $request->UserName;
        $user->email = $request->UserEmail;
        //admin and sysadmin always active
        $user->active = ($request->UserActive || in_array($user->id, [1, 2])) ? 1 : 0;
        //disconnect inactive users except connected user
        if (!$user->active && $request->id != Auth::id())
            Sessions::deleteUserSessionByUserId($request->id);
        //update role when current role difference of request role and user not sysadmin or admin
        if (($request->allRoles != $user->role_id) && (!in_array($user->id, [1, 2]))) {
            $this->updateUserRole($request->allRoles, $user->id);
            $user->role_id = $request->allRoles;
        }
        if ($file = $request->file('UserImage')) {
            $path = public_path('assets/files/users/' . $request->id);
            $file->move($path, 'profiel.jpg');
        }
        $user->update();
        return $this->returnSuccess('user.update_user_succesfuly');
    }

    /**
     * change user status
     * @param UserActivate $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function refreshUserRole(UserUpdateRole $request)
    {
        $rolePermissions = Role::find($request->role_id)->permissions()->pluck('permissions.id');
        User::find($request->user_id)->permissions()->sync($rolePermissions);
        return $this->returnSuccess('user.update_permissions_successfully', $request->all());
    }

    /**
     * create folder for user
     * @param $path
     * @return void
     */
    public function createDirecrotory($path)
    {
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    /**
     * copy default image to user image
     * @param $path
     * @return void
     */
    public function moveDefaultImageTo($path)
    {
        File::copy(public_path('assets/files/default_image/profiel.jpg'), $path);
    }

    /**
     * set localization
     *
     * @param string $local
     * @return void
     */
    public function lang($locale)
    {
        if (in_array($locale, ['fr', 'en', 'ar'])) {
            App::setLocale($locale);
            session()->put('locale', $locale);
            $user = User::find(Auth::id());
            $user->lang = $locale;
            $user->update();
        }
        return redirect()->back();
    }

    /**
     * get user permission
     * @param UserGetPermission $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function permissions(UserGetPermission $request)
    {
        $permissionMenus = Menu::with(['permissions'])->whereNull('parent_id')->get();
        $user = User::find($request->id);
        $userConnectedPermissions = \Auth::user()->permissions()->get();
        $user_permission = $user->permissions()->get();
        foreach ($permissionMenus as $permissionMenu)
            foreach ($permissionMenu->permissions as $permissions) {
                $permissions['activated'] = ($user_permission->contains('name', $permissions->name)) ? 1 : 0;
                $permissions['can_update'] = ($userConnectedPermissions->contains('name', $permissions->name)) ? 1 : 0;
            }
        return $this->returnSuccess('user.get_permissions_successfully', $permissionMenus);
    }

    /**
     * update  user permission
     * @param UserUpdatePermissions $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updatePermissions(UserUpdatePermissions $request)
    {
        $usersModel = new User();
        $permissionsModel = new Permission();
        $connectedUserMenuPermission = $usersModel->getUserConnectedPermissionMenu($request->menuId);
        $users = $usersModel->findOrFail($request->userId);
        $permissionMenu = $permissionsModel->getPermissionsIdByMenuId($request->menuId);
        $permissions = $permissionsModel->whereIn('name', $connectedUserMenuPermission)->whereIn('name', collect($request->except('menuId', 'roleId'))->keys())->pluck('id');
        $users->permissions()->wherePivotIn('permission_id', $permissionMenu)->sync($permissions);
        $permmisionAfterUpdate = $users->permissions()->wherePivotIn('permission_id', $permissions)->get();

        return $this->returnSuccess('user.update_permissions_successfully', $permmisionAfterUpdate);
    }

    /**
     * update  user role
     * @param $roleId
     * @param $userId
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updateUserRole($roleId, $userId)
    {
        $rolePermissions = Role::find($roleId)->permissions()->pluck('permissions.id');
        User::find($userId)->permissions()->sync($rolePermissions);
        return true;
    }


}
