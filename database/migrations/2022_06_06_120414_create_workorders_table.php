<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->bigInteger('vendor_id')->index()->unsigned()->nullable();
            $table->bigInteger('srequipment_id')->index()->unsigned()->nullable();
            $table->string('uniquecode');
            $table->text('maintoption')->nullable();
            $table->text('description')->nullable();
            $table->string('verifiedby')->nullable();
            $table->string('dateverified')->nullable();
            $table->string('amount')->nullable();
            $table->string('duedateformaint')->nullable();
            
            $table->string('firstapprover')->nullable();
            $table->string('firstapproveddate')->nullable();
            $table->text('firstapprovercomment')->nullable();
            $table->tinyInteger('isapproved1')->default('0');

            $table->string('secondapprover')->nullable();
            $table->string('secondapproveddate')->nullable();
            $table->text('secondapprovercomment')->nullable();
            $table->tinyInteger('isapproved2')->default('0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('srequipment_id')->references('id')->on('srequipments')->onDelete('cascade');
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
        Schema::dropIfExists('workorders');
    }
}
