<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit ;

class House extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', "type"];

    protected $table = 'houses';


}
