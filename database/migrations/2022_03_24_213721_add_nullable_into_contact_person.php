<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableIntoContactPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_persons', function (Blueprint $table) {
            $table->dropUnique(['cid_number']);
            $table->bigInteger('cperson_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_persons', function (Blueprint $table) {
            $table->dropColumn(['cperson_no']);
        });
    }
}
