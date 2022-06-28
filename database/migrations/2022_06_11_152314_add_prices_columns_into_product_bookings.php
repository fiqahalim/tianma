<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricesColumnsIntoProductBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_bookings', function (Blueprint $table) {
            $table->string('price')->nullable()->after('seats');
            $table->string('promo')->nullable()->after('seats');
            $table->string('maintenance')->nullable()->after('seats');
            $table->string('point_value')->nullable()->after('seats');
            $table->string('available')->nullable()->after('seats');
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
            $table->dropColumn(['price','promo','maintenance','point_value','available']);
        });
    }
}
