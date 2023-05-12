<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Audits extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }

    public function auditable()
    {
        return $this->morphTo();
    }
}
