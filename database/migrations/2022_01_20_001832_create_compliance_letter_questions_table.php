<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplianceLetterQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliance_letter_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_fulfilled')->default(false);
            $table->string('observation')->nullable();
            $table->foreignId('compliance_letter_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('compliance_letter_questions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compliance_letter_questions');
    }
}
