<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalanceColumnsIntoTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('balance', 15, 2)->nullable()->after('amount');
            $table->string('status')->nullable()->after('amount');
            $table->renameColumn('trans_name', 'trans_no');
            $table->date('transaction_date')->change();

            $table->unsignedBigInteger('installment_id')->nullable();
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['balance', 'status']);
        });
    }
}
