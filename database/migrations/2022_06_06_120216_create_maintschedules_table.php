<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintschedules', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('srequipment_id')->index()->unsigned()->nullable();
            $table->string('schedulecode')->nullable();
            $table->string('maintcycle')->nullable();
            $table->string('duedateformaint')->nullable();
            $table->tinyInteger('ismaintained')->default('0');
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->string('mainttype')->nullable();
            $table->text('comment')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('srequipment_id')->references('id')->on('srequipments')->onDelete('cascade');
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
        Schema::dropIfExists('maintschedules');
    }
}
