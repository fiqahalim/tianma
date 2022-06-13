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
            $table->decimal('price', 15, 2)->nullable()->after('seats');
            $table->decimal('promo', 15, 2)->nullable()->after('seats');
            $table->decimal('maintenance', 15, 2)->nullable()->after('seats');
            $table->float('point_value', 15, 2)->nullable()->after('seats');
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
