<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitorbookings', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->string('bookingnum');
            $table->string('visitorname');
            $table->string('visitingdate');
            $table->string('visitingtime');
            $table->string('purpose');
            $table->tinyInteger('isapproved')->default('0');
            $table->string('approvedby')->nullable();
            $table->string('approved_at')->nullable();
            $table->tinyInteger('isclosed')->default('0');
            $table->tinyInteger('iscancelled')->default('0');
            $table->string('cancelledby')->nullable();
            $table->string('cancelled_at')->nullable();
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
        Schema::dropIfExists('visitorbookings');
    }
}
