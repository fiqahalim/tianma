<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDeceaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deceased_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('lot_id')->nullable()->after('item_elements');
            $table->foreign('lot_id')->references('id')->on('product_bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deceased_infos', function (Blueprint $table) {
            $table->dropColumn(['lot_id']);
        });
    }
}
