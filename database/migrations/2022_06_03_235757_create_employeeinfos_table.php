<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeeinfos', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('state_id')->unsigned()->index()->nullable();
            $table->bigInteger('lga_id')->unsigned()->index()->nullable();
            $table->bigInteger('location_id')->unsigned()->index()->nullable();
            $table->string('title')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('dob')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('spousename')->nullable();
            $table->string('spouseemployer')->nullable();
            $table->string('spousephone')->nullable();
            $table->string('qualification')->nullable();
            $table->string('profession')->nullable();
            $table->string('jobtitle')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('dateofemployment')->nullable();
            $table->string('nextofkin')->nullable();
            $table->text('nokaddress')->nullable();
            $table->string('nokphone')->nullable();
            $table->string('nokrelationship')->nullable();
            $table->string('acceptdeclaration')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('lga_id')->references('id')->on('lgas')->onDelete('cascade');
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
        Schema::dropIfExists('employeeinfos');
    }
}
