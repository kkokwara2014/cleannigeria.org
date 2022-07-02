<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceassessmentusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competenceassessmentusers', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('competenceassessment_id')->index()->unsigned()->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('sentto_id')->index()->unsigned()->nullable();
            $table->bigInteger('senttosuperior_id')->index()->unsigned()->nullable();
            $table->bigInteger('finalassessor_id')->index()->unsigned()->nullable();
            $table->foreign('competenceassessment_id')->references('id')->on('competenceassessments')->onDelete('cascade');
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
        Schema::dropIfExists('competenceassessmentusers');
    }
}
