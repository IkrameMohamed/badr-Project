<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Metabolite extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    public function medicines(){
        return $this->hasMany('App\Medicine');
    }

    public static function getMetabolitesIdByNames($names){
        return DB::table('metabolites')
            ->whereIn('name', $names)->pluck('id');
    }


}