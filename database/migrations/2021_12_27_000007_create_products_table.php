<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('product_id_number')->nullable();
            $table->string('product_code')->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('selling_price', 15, 2);
            $table->decimal('maintenance_price', 15, 2);
            $table->decimal('list_price', 15, 2);
            $table->float('point_value', 15, 2);
            $table->integer('quantity_per_unit')->nullable();
            $table->decimal('total_cost', 15, 2);
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
