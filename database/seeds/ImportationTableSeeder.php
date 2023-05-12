<?php

use Illuminate\Database\Seeder;
use App\ImportationTable;

class ImportationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables_data = array(
            array(
                'id' => 1,
                'table_name' => 'medicines',
                'check_foreign_key' => 1,
                'check_unique_key_in_temp' => 1,
                'check_unique_key_in_origin' => 1,
                'check_required_field' => 1,
                'check_field_type' => 1,
                'check_detail_table_validation' => 1,
                'check_duplicate_field' => 1,
            )
        );
        foreach ($tables_data as $table)
            ImportationTable::create($table);

    }
}
