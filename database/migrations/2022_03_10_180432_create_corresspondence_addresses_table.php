<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorresspondenceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondence_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('curpostcode')->nullable();
            $table->string('curstate')->nullable();
            $table->string('curcity')->nullable();
            $table->string('curaddress_1')->nullable();
            $table->string('curaddress_2')->nullable();
            $table->string('curnationality')->nullable();
            $table->string('curcountry')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on(DB::raw('customers'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correspondence_addresses');
    }
}
