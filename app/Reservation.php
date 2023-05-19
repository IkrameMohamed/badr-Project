<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit ;

class Reservation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['start_date','end_date'];

    protected $table = 'reservations';


    public function getReservationsWithUserAndHouse(){
        return DB::table('reservations')
            ->select('reservations.id', 'reservations.start_date', 'reservations.end_date', 'houses.name as house_name', 'users.name as user_name')
            ->join('beds','beds.id','=','reservations.bed_id')
            ->join('users','users.id','=','reservations.user_id')
            ->join('houses','beds.house_id','=','houses.id')
            ->get();;
    }

}
