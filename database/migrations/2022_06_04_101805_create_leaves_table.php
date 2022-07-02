<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('sendto_id')->unsigned()->index()->nullable();
            $table->bigInteger('leavetype_id')->unsigned()->index()->nullable();
            $table->string('numofdays');
            $table->string('starting');
            $table->string('ending');
            $table->text('description')->nullable();
            $table->tinyInteger('isapproved')->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('leavetype_id')->references('id')->on('leavetypes')->onDelete('cascade');
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
        Schema::dropIfExists('leaves');
    }
}
