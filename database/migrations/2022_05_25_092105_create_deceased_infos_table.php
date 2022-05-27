<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeceasedInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceased_infos', function (Blueprint $table) {
            $table->id();
            $table->string('decease_name');
            $table->string('decease_id_number')->unique();
            $table->string('decease_chinese_name')->nullable();
            $table->string('decease_gender');
            $table->string('decease_religion')->nullable();
            $table->string('decease_maritial')->nullable();
            $table->string('decease_dialect')->nullable();
            $table->string('decease_national')->nullable();
            $table->decimal('decease_income')->nullable();
            $table->string('decease_occupation')->nullable();
            $table->string('miling_flag')->nullable();
            $table->string('open_niche')->nullable();
            $table->string('undertaker')->nullable();
            $table->string('ref_no')->unique();
            $table->string('bury_cert')->nullable();
            $table->string('cremation_cert')->nullable();
            $table->string('casket')->nullable();
            $table->dateTime('chinese_birth_date')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->dateTime('death_date')->nullable();
            $table->dateTime('bury_date')->nullable();
            $table->dateTime('grain_date')->nullable();
            $table->integer('issue_postcode')->nullable();
            $table->string('issue_state')->nullable();
            $table->string('issue_city')->nullable();
            $table->string('issue_address_1')->nullable();
            $table->string('issue_address_2')->nullable();
            $table->string('issue_country')->nullable();
            $table->integer('funeral_postcode')->nullable();
            $table->string('funeral_state')->nullable();
            $table->string('funeral_city')->nullable();
            $table->string('funeral_address_1')->nullable();
            $table->string('funeral_address_2')->nullable();
            $table->string('funeral_country')->nullable();
            $table->text('remark')->nullable();
            $table->text('item_elements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deceased_infos');
    }
}
