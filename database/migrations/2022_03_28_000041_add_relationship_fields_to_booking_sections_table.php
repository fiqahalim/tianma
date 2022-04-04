<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingSectionsTable extends Migration
{
    public function up()
    {
        Schema::table('booking_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('lot_layout_id')->nullable();
            $table->foreign('lot_layout_id', 'lot_layout_fk_6309463')->references('id')->on('booking_lots');
        });
    }
}
