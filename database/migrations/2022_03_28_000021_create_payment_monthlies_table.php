<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMonthliesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_monthlies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('month')->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
