<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class ImportationDataInfo extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function dropTable()
    {
        Schema::dropIfExists('importation_data_infos');
    }

    public static function createTable($tableColumns)
    {
        ImportationDataInfo::dropTable();
        Schema::create('importation_data_infos', function ($table) use ($tableColumns) {
            $table->id();
            foreach ($tableColumns as $column)
                $table->string($column)->nullable();;
        });
    }


}
