<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importation_tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_name');
            $table->boolean('check_foreign_key')->default(0);
            $table->boolean('check_unique_key_in_temp')->default(0);
            $table->boolean('check_unique_key_in_origin')->default(0);
            $table->boolean('check_required_field')->default(0);
            $table->boolean('check_field_type')->default(0);
            $table->boolean('check_detail_table_validation')->default(0);
            $table->boolean('check_duplicate_field')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importation_tables');
    }
}
