<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Bed;
use App\Doctor;
use App\Http\Middleware\EncryptCookies;
use App\Http\Requests\ReservationRequest\ReservationCreate;
use App\Http\Requests\ReservationRequest\ReservationDelete;
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

class ReservationController extends Controller
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
        if (Gate::allows('reservations') == false) {
            redirect('/')->send();
        }

        return view('reservation.index');


    }
    public function datatable(Request $request)
    {
        $reservation = new Reservation;
        return Datatables::of($reservation->getReservationsWithUserAndHouse())->make(true);
    }


    public function create(ReservationCreate $request)
    {


        $bed = new Bed;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $house = $request->house;
        $beds_number = $request->beds_number;
        $beds = $bed->beds_available($startDate,$endDate,$house);
        $x = 1;

        if($beds_number > $beds->count() || $beds_number > 2)
            return $this->returnError('appointment.error_validation');

        foreach ($beds as $b){
            if($x <= $beds_number){
                $reservation = new Reservation;
                $reservation->start_date = $startDate;
                $reservation->end_date = $endDate;
                $reservation->user_id = auth()->id();
                $reservation->bed_id = $b->id;
                $reservation->save();
            }
            $x++;
        }
        return $this->returnSuccess('appointment.create_appointment_succesfuly');
    }


    public function delete(ReservationDelete $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->delete();

        return $this->returnSuccess('appointment.delete_appointment_succesfuly');
    }

}
