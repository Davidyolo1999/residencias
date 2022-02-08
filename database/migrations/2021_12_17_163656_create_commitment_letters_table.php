<?php

use App\Enum\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitmentLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commitment_letters', function (Blueprint $table) {
            $table->id();
            $table->dateTime('request_date');
            $table->string('signed_document')->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('company_id');
            $table->string('status')->default(DocumentStatus::STATUS_PROCESSING);
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('students')->onDelete('CASCADE');
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
        Schema::dropIfExists('commitment_letters');
    }
}
