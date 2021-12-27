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
            $table->decimal('commission', 15, 2)->nullable();
            $table->decimal('increased_commission', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
