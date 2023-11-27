<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->string('company_id');
            $table->string('total_amount')->nullable();
            $table->string('total_paid')->nullable();
            $table->string('total_dues')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('company_invoices');
    }
}
