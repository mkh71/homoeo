<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->bigInteger('qty')->nullable();
            $table->integer('power_id')->nullable();
            $table->string('pack_size')->nullable();
            $table->unsignedDouble('net_price')->nullable();
            $table->unsignedDouble('mrp_price')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('group')->nullable();
            $table->date('expired_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('power_id');
            $table->dropColumn('pack_size');
            $table->dropColumn('net_price');
            $table->dropColumn('mrp_price');
            $table->dropColumn('company_id');
            $table->dropColumn('group');
            $table->dropColumn('expired_date');
        });
    }
}
