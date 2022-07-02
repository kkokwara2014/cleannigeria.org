<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('staffcategory_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('userimage')->default('defaultuserimage.jpg');
            $table->string('leaveent')->default('30');
            $table->tinyInteger('isactive')->default('1');
            $table->tinyInteger('profileupdated')->default('0');
            $table->tinyInteger('isonleave')->default('0');
            $table->bigInteger('company_id')->unsigned()->nullable()->index();
            $table->datetime('login_at')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
