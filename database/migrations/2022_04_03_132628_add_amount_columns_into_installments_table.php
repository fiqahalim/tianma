<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountColumnsIntoInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installments', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->nullable()->after('downpayment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installments', function (Blueprint $table) {
            $table->dropColumn(['amount']);
        });
    }
}
