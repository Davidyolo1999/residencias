<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('fathers_last_name');
            $table->string('mothers_last_name');
            $table->string('curp', 18);
            $table->char('sex');
            $table->string('phone_number', 10);
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('locality_id');
            $table->unsignedBigInteger('career_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('state_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('municipality_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('locality_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
