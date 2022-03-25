<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationsPivotTableIntoBookingSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->unsignedBigInteger('product_types_id')->nullable();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('building_id')->references('id')->on('building_types');
            $table->foreign('product_types_id')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_sections', function (Blueprint $table) {
            $table->dropColumn(['location_id', 'building_id', 'product_types_id']);
        });
    }
}
