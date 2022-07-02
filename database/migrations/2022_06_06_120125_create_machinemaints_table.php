<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinemaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machinemaints', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('uniquenumb')->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('schedule_id')->index()->unsigned()->nullable();
            $table->text('actiontaken')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->tinyInteger('isapproved')->nullable()->default('0');
            $table->tinyInteger('ismaintained')->nullable()->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
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
        Schema::dropIfExists('machinemaints');
    }
}
