<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportationTable extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function tableFields(){
        return $this->hasMany('App\ImportationTableField');
    }
    public function tableFkFields(){
        return $this->hasMany('App\ImportationTableFkField');
    }
    public function tableUqFields(){
        return $this->hasMany('App\ImportationTableUqField');
    }

    public function tableDuplicatedFields(){
        return $this->hasMany('App\ImportationTableDuplicateField');
    }

    public static function getTableStructure($table_name){
        return ImportationTable::with(['tableFields', 'tableFkFields', 'tableFkFields.parentFkFeilds',
            'tableUqFields', 'tableDuplicatedFields'])->where("table_name", "=", $table_name)->first()->toArray();
    }

}
