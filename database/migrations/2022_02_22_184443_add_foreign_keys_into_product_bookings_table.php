<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysIntoProductBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_lots_id')->nullable();
            $table->foreign('booking_lots_id')->references('id')->on('booking_lots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_bookings', function (Blueprint $table) {
            //
        });
    }
}
