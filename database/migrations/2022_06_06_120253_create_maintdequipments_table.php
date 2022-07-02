<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintdequipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintdequipments', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('maintschedule_id')->index()->unsigned()->nullable();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->text('activitydone')->nullable();
            $table->string('maintstartdate')->nullable();
            $table->string('maintenddate')->nullable();
            $table->tinyInteger('isapproved')->default('0');
            $table->string('approvedby')->nullable();
            $table->string('approverphone')->nullable();
            $table->string('approvedon')->nullable();
            $table->string('maintreportfile')->nullable();
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
        Schema::dropIfExists('maintdequipments');
    }
}
