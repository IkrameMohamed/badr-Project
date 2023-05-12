<?php

use Illuminate\Database\Seeder;
use App\ImportationTableFkField;

class ImportationTableFkFieldSeeder extends Seeder
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
                'field_name' => 'symptomes',
                'field_reference' => "name",
                'fk_table_name'  => 'symptomes',
                'fk_table_id_name'  => 'id',
                'required' => 1,
                'validation_type' => "string",
                'position' => 2,
                'importation_table_id' => 1,
            ),
            array(
                'id' => 2,
                'field_name' => 'criteres',
                'field_reference' => "name",
                'required' => 1,
                'fk_table_name'  => 'criteres',
                'fk_table_id_name'  => 'id',
                'validation_type' => "string",
                'position' => 3,
                'importation_table_id' => 1,
            ),
            array(
                'id' => 3,
                'field_name' => 'métabolites',
                'field_reference' => "name",
                'required' => 1,
                'fk_table_name'  => 'métabolites',
                'fk_table_id_name'  => 'id',
                'validation_type' => "string",
                'position' => 4,
                'importation_table_id' => 1,
            ),
            array(
                'id' => 4,
                'field_name' => 'critères_analytiques',
                'field_reference' => "name",
                'required' => 1,
                'fk_table_name'  => 'critères_analytiques',
                'fk_table_id_name'  => 'id',
                'validation_type' => "string",
                'position' => 5,
                'importation_table_id' => 1,
            ),
        );
        foreach ($tables_data as $table)
            ImportationTableFkField::create($table);

    }
}
