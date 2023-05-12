<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('appointment_date');
            $table->boolean('checked')->default(false);
            $table->foreignId('doctor_id')->constrained('doctors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('visit_type_id')->constrained('visit_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')
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
        Schema::dropIfExists('appointments');
    }
}
