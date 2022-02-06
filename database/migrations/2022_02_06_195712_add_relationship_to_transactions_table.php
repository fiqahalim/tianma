<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('created_by')->references('id')->on(DB::raw('users'));
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
            $table->dropColumn(['customer_id','created_by']);
        });
    }
}
