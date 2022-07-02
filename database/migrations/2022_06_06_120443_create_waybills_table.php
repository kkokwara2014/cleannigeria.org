<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waybills', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('waybilllocation_id')->index()->unsigned()->nullable();
            $table->string('waybillnum')->nullable();
            $table->text('destination')->nullable();
            $table->string('vehiclenum')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('approver_id')->nullable();
            $table->tinyInteger('isrecieved')->default('0');
            $table->tinyInteger('isapproved')->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('waybilllocation_id')->references('id')->on('waybilllocations')->onDelete('cascade');
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
        Schema::dropIfExists('waybills');
    }
}
