<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSectionRoomPivotTable extends Migration
{
    public function up()
    {
        Schema::create('booking_section_room', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_id_fk_6303089')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('booking_section_id');
            $table->foreign('booking_section_id', 'booking_section_id_fk_6303089')->references('id')->on('booking_sections')->onDelete('cascade');
        });
    }
}
