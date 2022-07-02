<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispersantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispersants', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->text('caption')->nullable();
            $table->text('evidence')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('legend_id')->unsigned()->index()->nullable();
            $table->bigInteger('competenceassessment_id')->unsigned()->index()->nullable();
            $table->tinyInteger('isassessed')->default('0');
            $table->tinyInteger('isapproved')->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('legend_id')->references('id')->on('legends')->onDelete('cascade');
            $table->foreign('competenceassessment_id')->references('id')->on('competenceassessments')->onDelete('cascade');
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
        Schema::dropIfExists('dispersants');
    }
}
