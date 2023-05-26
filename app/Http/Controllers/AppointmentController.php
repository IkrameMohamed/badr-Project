<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Http\Requests\AppointmentRequest\AppointmentCreate;
use App\Http\Requests\AppointmentRequest\AppointmentDelete;
use App\Http\Requests\AppointmentRequest\ReservationCreate;
use App\Http\Requests\AppointmentRequest\ReservationDelete;
use App\Http\Requests\AppointmentRequest\CheckedAppointment;
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
use function Symfony\Component\Translation\t;

class AppointmentController extends Controller
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
        if (Gate::allows('appointments') == false) {
            redirect('/')->send();
        }

        return view('appointment.index');
    }

    public function createValidation($doctor_id)
    {

        $doctor = Doctor::find($doctor_id);

        if ($doctor == null)
            return false;

        if ($doctor->number_days_available <= 0)
            return false;

        return true;
    }

    public function create(AppointmentCreate $request)
    {
        if (!$this->createValidation($request->doctor))
            return $this->returnError('appointment.sorry_there_is_an_validation_error_contact_admin_for_more_information');

        $doctor = Doctor::find($request->doctor);
        $doctor->number_days_available = $doctor->number_days_available - 1;
        $doctor-> save();
        $appointments = new Appointment;
        $appointments->appointment_date = $request->appointment_date;
        $appointments->doctor_id = $doctor->id;
        $appointments->visit_type_id = $request->visit_type;
        $appointments->user_id = auth()->id();
        $appointments->save();
        return $this->returnSuccess('appointment.create_appointment_succesfuly');
    }

    public function checkedAppointment(CheckedAppointment $request)
    {
        $appointments = Appointment::find($request->id);
        $appointments->checked = true;
        $appointments->save();
        $doctor = Doctor::find($appointments->doctor_id);
        $doctor->number_days_available = $doctor->number_days_available + 1;
        $doctor-> save();
        return $this->returnSuccess('appointment.delete_appointment_succesfuly');
    }

    public function delete(AppointmentDelete $request)
    {
        $appointments = Appointment::find($request->id);
        $appointments->delete();
        $doctor = Doctor::find($appointments->doctor_id);
        $doctor->number_days_available = $doctor->number_days_available + 1;
        $doctor-> save();

        return $this->returnSuccess('appointment.delete_appointment_succesfuly');
    }

    public function datatable(Request $request)
    {
        $appointments = Appointment::with(['doctor','visitType','user'])->get();
        return Datatables::of($appointments)->make(true);
    }

}
