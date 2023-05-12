<?php

namespace App\Http\Controllers;

use App\Exports\MedicineExport;
use App\ImportationDataInfo;
use App\ImportationTable;
use App\ImportationTableField;
use App\ImportationTableFkField;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\GlobalImport;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ImportationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function import(Request $request)
    {

        $ExcelHeadings = (new HeadingRowImport)->toArray(request()->file('file'));

        if (!isset($ExcelHeadings[0][0]))
            return $this->returnError('importation.please_check_table_header');

        $table_name = $request->table_name;

        if (!isset($table_name))
            return $this->returnError('importation.please_enter_table_name');

        $tableStructure = ImportationTable::getTableStructure($table_name);

        if (is_null($tableStructure))
            return $this->returnError('importation.Wrong_table_name_please_contact_admin');

        $tableColumns = getTableFields($tableStructure,array("onlyColumnsNames" => true));

        if (!keysAreEqual($tableColumns, $ExcelHeadings[0][0]))
            return $this->returnError('importation.please_check_header_of_u_excel_to_match_with_pre_defined_structure');

        ImportationDataInfo::createTable($tableColumns);

        Excel::import(new GlobalImport, request()->file('file'));

        $this->insertData($table_name);

        return $this->returnSuccess('importation.import_data_with_success');
    }

    public function insertData($table_name)
    {
        switch ($table_name){
            case 'medicines':
                DB::statement('call importationMedicine()');
                break;
            default:
                break;
        }
    }

    public function export(Request $request)
    {
        $table_name = $request->route('table_name');
        switch ($table_name){
            case 'medicines':
                return Excel::download(new MedicineExport(), $table_name . '.xlsx');
                break;
            default:
                break;
        }
    }


}
