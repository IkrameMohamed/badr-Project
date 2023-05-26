<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\AppointmentRequest\ReservationCreate;
use App\Medicine;
use App\Permission;
use App\Menu;
use App\Role;
use App\User;
use App\Sessions;
use App\ReceiptFieldRelation;

use App\VisitType;
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

class VisitTypeController extends Controller
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
        return view('appointment.index');
    }

    public function doctors(Request $request){
        $visitTypesDoctors = VisitType::with(['doctors'])->get();
        return $this->returnSuccess('user.get_permissions_successfully', $visitTypesDoctors);
    }

}
