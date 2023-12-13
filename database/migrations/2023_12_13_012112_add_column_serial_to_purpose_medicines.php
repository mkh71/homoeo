<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSerialToPurposeMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purpose_medicines', function (Blueprint $table) {
            $table->string('serial');
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
            $table->dropColumn('serial');
        });
    }
}
