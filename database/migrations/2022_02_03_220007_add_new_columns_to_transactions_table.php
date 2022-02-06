<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('trans_name', 'mode');
            $table->decimal('downpayment', 15, 2)->nullable();
            $table->decimal('outstanding_balance', 15, 2)->nullable();
            $table->decimal('installment', 15, 2)->nullable();
            $table->decimal('installment_balance', 15, 2)->nullable();
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['mode','downpayment','outstanding_balance','installment','installment_balance']);
        });
    }
}
