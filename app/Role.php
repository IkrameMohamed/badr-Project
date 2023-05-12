<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Role extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id'
    ];

    public function users(){
        return $this->hasMany('App\User','role_id');
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }

    /**
     *get user where
     */
    public function getReguaireRoles(){
        return Role::whereNotIn('id', [1])->get();
    }
}
