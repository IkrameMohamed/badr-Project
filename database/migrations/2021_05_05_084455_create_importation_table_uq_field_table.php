<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportationTableUqFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importation_table_uq_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->string('field_reference');
            $table->string('table_name');
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
        Schema::dropIfExists('importation_table_uq_fields');
    }
}
