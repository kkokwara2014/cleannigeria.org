<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEntranceToScannerlocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scannerlocations', function (Blueprint $table) {
            $table->boolean('is_entrance')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scannerlocations', function (Blueprint $table) {
            $table->dropColumn('is_entrance');
        });
    }
}
