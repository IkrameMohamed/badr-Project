<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $table = 'achats';

    protected $fillable = [
        'user_id',
        'product_id',
        'ordonnance'
    ];

    public function user(){
        return $this::belongsTo('App\User');
    }

    public function product(){
        return $this::belongsTo('App\Product');
    }
}
