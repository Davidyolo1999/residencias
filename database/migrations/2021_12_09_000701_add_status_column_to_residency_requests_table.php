<?php

use App\Enum\DocumentStatus;
use App\Models\ResidencyRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToResidencyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->string('status')->default(DocumentStatus::STATUS_PROCESSING)->after('company_id');
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
            $table->dropColumn('status');
        });
    }
}
