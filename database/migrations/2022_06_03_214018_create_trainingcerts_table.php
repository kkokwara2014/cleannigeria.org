<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingcertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainingcerts', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('certnumber')->index()->nullable();
            $table->string('uniquecode')->index()->nullable();
            $table->string('issuedon')->index()->nullable();
            $table->string('validityperiod')->nullable();
            $table->string('approver_id')->nullable();
            $table->tinyInteger('isapproved')->default('0');
            $table->foreignId('trainee_id')->constrained();
            $table->foreignId('training_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('trainingcerts');
    }
}
