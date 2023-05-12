<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineMetaboliteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_metabolite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained('medicines')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('metabolite_id')->constrained('metabolites')
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
        Schema::dropIfExists('medicine_metabolite');
    }
}
