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
            $table->string('decease_chinese_name');
            $table->string('decease_gender');
            $table->string('decease_religion');
            $table->string('decease_maritial');
            $table->string('decease_dialect');
            $table->string('decease_national');
            $table->string('decease_income');
            $table->string('decease_occupation');
            $table->string('miling_flag');
            $table->string('open_niche');
            $table->string('undertaker');
            $table->string('ref_no')->unique();
            $table->string('bury_cert');
            $table->string('cremation_cert');
            $table->string('casket');
            $table->dateTime('chinese_birth_date');
            $table->dateTime('birth_date');
            $table->dateTime('death_date');
            $table->dateTime('bury_date');
            $table->dateTime('grain_date');
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
            $table->text('remark');
            $table->text('item_elements');
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
