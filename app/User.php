<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit ;


class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'email', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'password','id'
    ];

    /**
     * get current user connected role.
     * @var array
     */
    public function role()
    {
        return $this::hasOne('App\Role');
    }

    /**
     * validation email
    */
    public function checkDuplicateEmails($id,$email){
        return (User::where('id', '!=',$id )->where('email',$email)->exists()) ? true  : false;
    }

    /**
     *get user where
     */
    public function getReguaireUsers(){
        return User::whereNotIn('id', [1])->get();
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }

    public function getUserConnectedPermissionMenu($menuId){
        return \Auth::user()->permissions()->where('permission_menu_id', $menuId)->pluck('permissions.name');
    }

    public function hasReceiptFieldRelation(){
        return $this->morphMany('App\ReceiptFieldRelation','table');
    }

    public function audit(){
        return $this->hasMany(Audit::class ,'user_id');
    }

}
