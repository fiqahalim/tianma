<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPaymentMonthlyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('installment_payment_monthly', function (Blueprint $table) {
            $table->unsignedBigInteger('installment_id');
            $table->foreign('installment_id', 'installment_id_fk_6309333')->references('id')->on('installments')->onDelete('cascade');
            $table->unsignedBigInteger('payment_monthly_id');
            $table->foreign('payment_monthly_id', 'payment_monthly_id_fk_6309333')->references('id')->on('payment_monthlies')->onDelete('cascade');
        });
    }
}
