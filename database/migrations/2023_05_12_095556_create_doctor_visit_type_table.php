<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorVisitTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_visit_type', function (Blueprint $table) {
            $table->id();
       $table->foreignId('doctor_id')->constrained('doctors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('visit_type_id')->constrained('visit_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_visit_type');
    }
}
