<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterdocregistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterdocregisters', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('doctitle')->unique()->index()->nullable();
            $table->text('slug')->nullable();
            $table->string('docnumber')->index()->nullable();
            $table->string('uniquecode')->index()->nullable();
            $table->string('revisionstatus')->nullable();
            $table->string('dateprepared')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->string('filename')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('masterdocregisters');
    }
}
