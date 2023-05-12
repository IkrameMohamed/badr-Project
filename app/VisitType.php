<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit ;

class VisitType extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name'];

    protected $table = 'visit_types';

    public function doctors(){
        return $this->belongsToMany('App\Doctor');
    }
}
