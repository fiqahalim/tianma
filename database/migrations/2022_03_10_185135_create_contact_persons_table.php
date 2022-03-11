<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cperson_name')->nullable();
            $table->string('cperson_no')->nullable();
            $table->string('cid_type')->nullable();
            $table->string('cid_number')->unique();
            $table->string('cemail')->nullable();
            $table->string('relationships')->nullable();
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
        Schema::dropIfExists('contact_persons');
    }
}
