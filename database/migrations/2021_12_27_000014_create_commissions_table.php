<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('mo_overriding_comm', 15, 2)->nullable();
            $table->decimal('mo_spin_off', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
