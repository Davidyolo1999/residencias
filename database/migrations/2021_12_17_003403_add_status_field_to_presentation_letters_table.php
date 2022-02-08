<?php

use App\Enum\DocumentStatus;
use App\Models\PresentationLetter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldToPresentationLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::table('presentation_letters', function (Blueprint $table) {
            $table->string('status')->default(DocumentStatus::STATUS_PROCESSING)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presentation_letters', function (Blueprint $table) {
           $table->dropColumn('status');
        });
    }
}
