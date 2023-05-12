<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    public $table = 'sessions';

    public static function getUserSessionByUserId($userId){
        return Sessions::where('user_id',$userId )->get();
    }

    public static function deleteUserSessionByUserId($userId){
        return Sessions::where('user_id',$userId )->delete();
    }

    public static function getAllUserSessions($userId){
        return Sessions::where('user_id', $userId)->get();
    }

    public static function deleteOldSession($userId){
         $session = Sessions::where('user_id', $userId)->orderBy('last_activity', 'ASC')->first();
         if($session)
             $session->delete();
         return true;
    }
    public static function deleteAllUserSessions($userId){
        return Sessions::where('user_id', $userId)->delete();
    }

}
