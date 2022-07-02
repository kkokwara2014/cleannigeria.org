<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('uniquenumb')->nullable();
            $table->string('name')->nullable();
            $table->text('slug')->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('location_id')->index()->unsigned()->nullable();
            $table->string('status')->nullable();
            $table->text('beforeuse')->nullable();
            $table->text('afteruse')->nullable();
            $table->text('monthly')->nullable();
            $table->text('quarterly')->nullable();
            $table->text('semiannually')->nullable();
            $table->text('annually')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
        Schema::dropIfExists('machines');
    }
}
