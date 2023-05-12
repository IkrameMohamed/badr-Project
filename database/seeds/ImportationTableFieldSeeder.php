<?php

use Illuminate\Database\Seeder;
use App\ImportationTableField;

class ImportationTableFieldSeeder extends Seeder
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
                'field_name' => 'médicament',
                'field_reference' => "name",
                'required' => 1,
                'validation_type' => "string",
                'position' => 1,
                'importation_table_id' => 1,
            )
        );
        foreach ($tables_data as $table)
            ImportationTableField::create($table);

    }
}
