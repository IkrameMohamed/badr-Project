<?php

namespace App\Imports;

use App\ImportationDataInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GlobalImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return ImportationDataInfo
     */
    public function model(array $row)
    {
        unset ($row[""]);
        $TempData = $row;
        if (count(array_filter($TempData)))
            return new ImportationDataInfo(
                $row
            );
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
