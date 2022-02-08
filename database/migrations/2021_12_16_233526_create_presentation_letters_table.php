<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_letters', function (Blueprint $table) {
            $table->id();
            $table->dateTime('request_date');
            $table->string('signed_document')->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('students')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation_letters');
    }
}
