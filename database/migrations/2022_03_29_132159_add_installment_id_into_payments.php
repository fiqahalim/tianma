<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstallmentIdIntoPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_monthlies', function (Blueprint $table) {
            $table->unsignedBigInteger('installment_id')->nullable()->after('status');
            $table->foreign('installment_id')->references('id')->on('installments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_monthlies', function (Blueprint $table) {
            $table->dropColumn(['installment_id']);
        });
    }
}
