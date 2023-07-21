<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\House;
use App\Http\Requests\AppointmentRequest\ReservationCreate;
use App\Http\Requests\AppointmentRequest\ReservationDelete;
use App\Http\Requests\AppointmentRequest\CheckedAppointment;
use App\Medicine;
use App\Permission;
use App\Menu;
use App\Reservation;
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
use function Symfony\Component\Translation\t;

class HouseController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function houses(Request $request){
        $user = User::find(auth()->id());
        $houses = House::all()->whereIn('type',[$user->type, 'ALL']);
        $data = [
            'houses' => $houses,
            'user_under_age' => $user->under_age,
            'user_handicap' => $user->handicap,
        ];
        return $this->returnSuccess('user.get_houses_succesfully', $data);
    }


}
