<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilizationrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobilizationrequests', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id');
            $table->string('refnumb');
            $table->string('membcomp');
            $table->string('notifier');
            $table->string('designation')->nullable();
            $table->string('directphone')->nullable();
            $table->string('mobilephone');
            $table->string('email');
            $table->string('centrenumb')->nullable();
            $table->string('dateofact');
            $table->string('timeofact');
            $table->string('spilldate');
            $table->string('spilltime')->nullable();
            $table->string('spillsource')->nullable();
            $table->string('spillcause')->nullable();
            $table->string('location')->nullable();
            $table->string('town')->nullable();
            $table->string('spillstatus');
            $table->text('productiontype')->nullable();
            $table->text('facility')->nullable();
            $table->text('environmenttype');
            $table->text('res_at_risk')->nullable();
            $table->text('numofpersonnel');
            $table->text('safetyinfo1');
            $table->text('safetyinfo2');
            $table->text('safetyinfo3')->nullable();
            $table->text('safetyinfo4')->nullable();
            $table->text('addedinfo')->nullable();
            $table->text('provision');
            $table->text('welfareprov')->nullable();
            $table->tinyInteger('isdone')->default('0');
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
        Schema::dropIfExists('mobilizationrequests');
    }
}
