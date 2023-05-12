.<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportationTableFkFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importation_table_fk_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->string('field_reference');
            $table->string('fk_table_name');
            $table->string('fk_table_id_name');
            $table->boolean('required')->default(1);
            $table->string('validation_type');
            $table->integer('position');
            $table->foreignId('importation_table_id')->constrained('importation_tables')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importation_table_fk_fields');
    }
}