<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookLocationForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('book_locations_id')->nullable()->after('status');
            $table->foreign('book_locations_id')->references('id')->on('book_locations');
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
            $table->dropColumn(['book_locations_id']);
        });
    }
}
