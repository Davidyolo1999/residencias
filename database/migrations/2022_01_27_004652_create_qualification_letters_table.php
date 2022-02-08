<?php

use App\Enum\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_letters', function (Blueprint $table) {
            $table->id();
            $table->dateTime('request_date');
            $table->string('signed_document')->nullable();
            $table->integer('qualification')->nullable();
            $table->string('qualification_text')->nullable();
            $table->string('status')->default(DocumentStatus::STATUS_PROCESSING);
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
        Schema::dropIfExists('qualification_letters');
    }
}
