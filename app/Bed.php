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

class Bed extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['code_bare'];

    protected $table = 'beds';

    public function beds_available($startDate , $endDate , $houseId){
        return DB::table('beds')
            ->select('beds.*')
            ->join('houses','houses.id','=','beds.house_id')
            ->where('houses.id','=',$houseId)
            ->whereNotIn('beds.id',(function ($query) use ($endDate, $startDate) {
                $query->from('reservations')
                    ->select('reservations.bed_id')
                    ->where('reservations.start_date','<=',$endDate)
                    ->where('reservations.end_date','>=',$startDate);}))
            ->get();
    }
}
