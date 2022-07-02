<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintrequests', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->index()->unsigned()->nullable();
            $table->string('maintcode');
            $table->string('membercompany')->nullable();
            $table->string('jobdesignation')->nullable();
            $table->string('directphone')->nullable();
            $table->string('email')->nullable();
            $table->string('dateofrequest')->nullable();
            $table->string('equipmenttype')->nullable();
            $table->string('equipmentlocation')->nullable();
            $table->string('mainttype')->nullable();
            $table->text('equipmentfault')->nullable();
            $table->string('cmdonebefore')->nullable();
            $table->string('sparepartavailable')->nullable();
            $table->string('sremaintinplace')->nullable();
            $table->string('expectedmaintdate')->nullable();
            $table->text('hseriskdesc')->nullable();
            $table->text('secriskdesc')->nullable();
            $table->text('secarrangementdesc')->nullable();
            $table->text('moreinfo')->nullable();
            $table->string('covidppe')->nullable();
            $table->string('accomodation')->nullable();
            $table->string('safetyoflocation')->nullable();
            $table->string('armedsecurity')->nullable();
            $table->string('transportation')->nullable();
            $table->string('communiservice')->nullable();
            $table->string('incidentsiteaccess')->nullable();
            $table->string('medicalservice')->nullable();
            $table->string('welfare')->nullable();
            $table->string('safetycriticaldevice')->nullable();
           
            
            $table->string('approver_id')->nullable();
            $table->string('approvaldate')->nullable();
            $table->text('approvercomment')->nullable();
            $table->tinyInteger('isapproved')->default('0');

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
        Schema::dropIfExists('maintrequests');
    }
}
