<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Symptom extends Model
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

    public function medicines()
    {
        return $this->hasMany('App\Medicine');
    }

    public static function getSymptomsIdByNames($names)
    {
        return DB::table('symptoms')
            ->whereIn('name', $names)->pluck('id');
    }


}
