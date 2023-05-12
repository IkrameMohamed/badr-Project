<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('active')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('lang',['en','fr','ar'])->default('fr');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreignId('role_id')->constrained('roles')
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
        Schema::dropIfExists('users');
    }
}
