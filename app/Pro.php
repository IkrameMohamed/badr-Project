<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'nom',
        'image',
        'category',
        'quantite'
    ];
 
}
