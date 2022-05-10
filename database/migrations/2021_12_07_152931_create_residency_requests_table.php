<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidencyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residency_requests', function (Blueprint $table) {
            $table->id();
            $table->dateTime('request_date');
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('company_id');
            
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('students')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residency_requests');
    }
}
