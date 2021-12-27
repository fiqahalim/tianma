<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_no')->unique();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamp('order_date')->nullable();
            $table->string('order_status')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on(DB::raw('users'));
        });
    }
}
