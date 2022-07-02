<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('uniquenumb')->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('machine_id')->index()->unsigned()->nullable();
            $table->bigInteger('schedtype_id')->index()->unsigned()->nullable();
            $table->string('nextmaintperiod')->nullable();
            $table->tinyInteger('isapproved')->nullable()->default('0');
            $table->tinyInteger('ismaintained')->nullable()->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('schedtype_id')->references('id')->on('schedtypes')->onDelete('cascade');
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
        Schema::dropIfExists('schedules');
    }
}
