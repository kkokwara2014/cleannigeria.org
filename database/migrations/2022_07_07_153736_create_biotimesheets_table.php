<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiotimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biotimesheets', function (Blueprint $table) {
            $table->id();
            $table->string('user_location');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->dateTime('clocked_in')->nullable();
            $table->dateTime('clocked_out')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('scannerlocations')->onDelete('cascade');
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
        Schema::dropIfExists('biotimesheets');
    }
}
