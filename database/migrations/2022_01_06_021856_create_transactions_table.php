<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_name')->nullable();
            $table->string('description')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();

            $table->foreign('order_id')->references('id')->on(DB::raw('orders'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
