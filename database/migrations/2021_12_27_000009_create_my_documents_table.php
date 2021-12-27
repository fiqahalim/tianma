<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('my_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_name')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
