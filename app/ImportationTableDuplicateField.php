<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportationTableDuplicateField extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function parentTable()
    {
        return $this->belongsTo('App\ImportationTable','importation_table_id');
    }

}
