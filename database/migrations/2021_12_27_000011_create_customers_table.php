<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('id_type')->nullable();
            $table->string('id_number')->unique();
            $table->string('email')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on(DB::raw('users'));
        });
    }
}
