<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignedDocumentFieldToResidencyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->string('signed_document')->nullable()->after('request_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->dropColumn('signed_document');
        });
    }
}
