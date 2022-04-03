<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentageIntoCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->float('point_value', 15, 2)->nullable()->after('mo_spin_off');
            $table->float('percentage', 15, 2)->nullable()->after('mo_spin_off');
            $table->float('first_month', 15, 2)->nullable()->after('mo_spin_off');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropColumn(['point_value', 'percentage', 'first_month']);
        });
    }
}
