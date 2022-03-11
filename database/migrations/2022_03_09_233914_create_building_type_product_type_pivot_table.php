<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingTypeProductTypePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_type_product_type', function (Blueprint $table) {
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id', 'product_type_id_fk_6168327')
                ->references('id')
                ->on('product_types')
                ->onDelete('cascade');
            $table->unsignedBigInteger('building_type_id');
            $table->foreign('building_type_id', 'building_type_id_fk_6168327')
                ->references('id')
                ->on('building_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_type_product_type');
    }
}
