<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHazardreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hazardreports', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('uniquenum')->nullable();
            $table->string('unsafeact')->nullable();
            $table->string('unsafecondition')->nullable();
            $table->string('riskcategory')->nullable();
            $table->text('description')->nullable();
            $table->text('correctiveaction')->nullable();
            $table->text('furtheraction')->nullable();
            $table->string('dateofoccurence')->nullable();
            $table->string('timeofoccurence')->nullable();
            $table->string('dateofreporting')->nullable();
            $table->string('timeofreporting')->nullable();
            $table->bigInteger('location_id')->unsigned()->index()->nullable();
            $table->tinyInteger('isclosed')->nullable()->default('0');
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
        Schema::dropIfExists('hazardreports');
    }
}
