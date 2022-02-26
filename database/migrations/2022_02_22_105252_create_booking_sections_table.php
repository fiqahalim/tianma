<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section')->nullable();
            $table->string('seat_layout')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->unsignedBigInteger('product_bookings_id')->nullable();
            $table->unsignedBigInteger('booking_lots_id')->nullable();

            $table->foreign('product_bookings_id')->references('id')->on('product_bookings');
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
        Schema::dropIfExists('booking_sections');
    }
}
