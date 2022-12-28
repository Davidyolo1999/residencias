<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start');
            $table->date('end');
            $table->string('unit');
            $table->string('address');
            $table->string('person_in_charge');
            $table->string('person_in_charge_position');
            $table->string('person_in_charge_position_abbreviation');
            $table->string('email');
            $table->string('office_phone_number');
            $table->string('personal_phone_number');
            $table->string('institution_code');
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
        Schema::dropIfExists('periods');
    }
}
