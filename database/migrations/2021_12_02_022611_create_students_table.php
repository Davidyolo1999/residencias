<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('first_name');
            $table->string('fathers_last_name');
            $table->string('mothers_last_name');
            $table->string('account_number', 8);
            $table->char('sex');
            $table->string('curp', 18);
            $table->string('rpa');
            $table->double('career_percentage');
            $table->string('phone_number', 10);
            $table->boolean('is_enrolled');
            $table->boolean('is_social_service_concluded');
            $table->unsignedBigInteger('career_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('external_advisor_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('locality_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('CASCADE');
            $table->foreign('teacher_id')->references('user_id')->on('teachers')->onDelete('CASCADE');
            $table->foreign('external_advisor_id')->references('user_id')->on('external_advisors')->onDelete('CASCADE');
            $table->foreign('state_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('municipality_id')->references('id')->on('locations')->onDelete('CASCADE');
            $table->foreign('locality_id')->references('id')->on('locations')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
