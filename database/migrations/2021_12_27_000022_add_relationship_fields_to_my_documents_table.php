<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMyDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('my_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('agents_id')->nullable();
            $table->foreign('agents_id', 'agents_fk_5482659')->references('id')->on('users');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by', 'created_by_fk_6109147')->references('id')->on('users');
        });
    }
}
