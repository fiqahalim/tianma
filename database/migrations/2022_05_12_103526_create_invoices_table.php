<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no', 20)->nullable();
            $table->date('doc_date')->nullable();
            $table->char('debtor_code', 12)->nullable();
            $table->char('journal_type', 10)->nullable();
            $table->char('display_term', 30)->nullable();
            $table->char('sales_agent', 12)->nullable();
            $table->string('description', 80)->nullable();
            $table->char('currency_code', 5)->nullable();
            $table->decimal('currency_rate')->nullable();
            $table->char('ref_no_2', 20)->nullable();
            $table->text('note')->nullable();
            $table->boolean('inclusive_tax')->nullable();
            $table->string('acc_no', 20)->nullable();
            $table->decimal('to_account_rate')->nullable();
            $table->string('detail_description', 100)->nullable();
            $table->string('proj_no', 10)->nullable();
            $table->string('dept_no', 10)->nullable();
            $table->string('tax_type', 8)->nullable();
            $table->decimal('taxable_amount')->nullable();
            $table->decimal('tax_adjustment')->nullable();
            $table->decimal('amount', 8,2)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
