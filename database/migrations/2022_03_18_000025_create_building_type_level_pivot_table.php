<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingTypeLevelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('building_type_level', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id', 'level_id_fk_6232872')->references('id')->on('levels')->onDelete('cascade');
            $table->unsignedBigInteger('building_type_id');
            $table->foreign('building_type_id', 'building_type_id_fk_6232872')->references('id')->on('building_types')->onDelete('cascade');
        });
    }
}
