<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByIntoDeceaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deceased_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('item_elements');
            $table->foreign('created_by')->references('id')->on('users');
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
            $table->dropColumn(['created_by']);
        });
    }
}
