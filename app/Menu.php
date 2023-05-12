<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use SoftDeletes;
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'menus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','href','att_id','class','icon','slug','parent_id','menu_type','sequence'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];


    public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id');
    }

    public function permissions(){
        return $this::hasMany('App\Permission','permission_menu_id','id');
    }

}
