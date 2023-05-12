<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name'
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }


    public function authUser(){
      $users = $this->belongsToMany('App\User');
      return  ($users->where('user_id', auth()->id()));
    }

    public function getPermissionsIdByMenuId($menuId){
        return $this->where('permission_menu_id', $menuId)->pluck('id');
    }


}
