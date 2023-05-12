<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class GlobalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function GetEnumValues(Request $request)
    {
        if (tableColumnValidation($request->table, $request->column)) {
            $form_field = getEnumValues($request->table, $request->column);
            return $this->returnSuccess('global.getting_column_enum_value_successfully', $form_field);
        }
        return $this->returnError('global.column_or_table_doesn\'t_exist');
    }


    public function GetTableList(Request $request)
    {
        if (Schema::hasTable($request->table)) {
            $table = getTableList($request->table);
            return $this->returnSuccess('global.table_list_successfully', $table);
        }
        return $this->returnError("global.table_does_not_exist");
    }

}
