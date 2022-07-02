<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSrequipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srequipments', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('refnumb');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('matricnumb')->nullable();
            $table->string('serialnumb')->nullable();
            $table->string('modelnumb')->nullable();
            $table->string('manufacdate')->nullable();
            $table->string('qty');
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('status');
            $table->bigInteger('store_id')->unsigned()->nullable()->index();
            $table->bigInteger('category_id')->unsigned()->nullable()->index();
            $table->bigInteger('itemunit_id')->unsigned()->nullable()->index();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->bigInteger('supplier_id')->unsigned()->nullable()->index();
            $table->tinyInteger('isscrapped')->default('0');
            $table->tinyInteger('ismaintained')->default('0');
            $table->tinyInteger('istransfered')->default('0');
            $table->tinyInteger('isapproved')->default('0');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('itemunit_id')->references('id')->on('itemunits')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
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
        Schema::dropIfExists('srequipments');
    }
}
