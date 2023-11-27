<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtyToPurposeMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purpose_medicines', function (Blueprint $table) {
            $table->bigInteger('qty')->nullable();
            $table->string('pack_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purpose_medicines', function (Blueprint $table) {
            $table->dropColumn('qty');
            $table->dropColumn('pack_size');
        });
    }
}
