<?php

namespace App\Exports;

use App\ImportationTable;
use Maatwebsite\Excel\Concerns\FromArray;

class MedicineExport implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {

        $tableStructure = ImportationTable::getTableStructure('medicines');

        $tableColumns = getTableFields($tableStructure,array("onlyColumnsNames" => true));

        return array($tableColumns);
    }
}
