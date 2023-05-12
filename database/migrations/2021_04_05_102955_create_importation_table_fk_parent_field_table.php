.<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportationTableFkParentFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importation_table_fk_parent_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->string('field_reference');
            $table->string('fk_table_name');
            $table->string('fk_table_id_name');
            $table->string('fk_table_parent_id_name');


            $table->unsignedBigInteger('importation_table_fk_field_id');
            $table->foreign('importation_table_fk_field_id',"fk_definitions")
                ->references('id')->on('importation_table_fk_fields')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importation_table_fk_parent_fields');
    }
}
