<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no', 20)->nullable();
            $table->date('doc_date')->nullable();
            $table->char('debtor_code', 12)->nullable();
            $table->string('description', 40)->nullable();
            $table->string('proj_no', 10)->nullable();
            $table->string('dept_no', 10)->nullable();
            $table->string('currency_code', 5)->nullable();
            $table->decimal('to_home_rate')->nullable();
            $table->decimal('to_debtor_rate')->nullable();
            $table->text('note')->nullable();
            $table->char('payment_method', 20)->nullable();
            $table->char('cheque_no', 20)->nullable();
            $table->decimal('payment_amount')->nullable();
            $table->decimal('bank_charge')->nullable();
            $table->decimal('to_bank_rate')->nullable();
            $table->char('payment_by', 20)->nullable();
            $table->smallInteger('float_day')->nullable();
            $table->boolean('isRCHQ')->nullable();
            $table->date('rchq_date')->nullable();
            $table->char('knock_off_doc_type', 2)->nullable();
            $table->char('knock_off_doc_no', 2)->nullable();
            $table->char('knock_off_amount', 2)->nullable();
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
        Schema::dropIfExists('payments');
    }
}
