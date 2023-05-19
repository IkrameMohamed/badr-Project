<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Bed;
use App\Doctor;
use App\House;
use App\Http\Requests\AppointmentRequest\AppointmentCreate;
use App\Http\Requests\AppointmentRequest\AppointmentDelete;
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

class BedController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function beds_available(Request $request)
    {

        $bed = new Bed;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $house = $request->house;
        $beds = $bed->beds_available($startDate,$endDate,$house);
        return $this->returnSuccess('user.get_houses_succesfully', $beds);
    }
}
