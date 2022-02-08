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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('request_role')->default('user');
            $table->string('usertype')->default('user');
            $table->integer('taka_amount')->default('0');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('pp')->nullable()->default('user.jpg');
            $table->MEDIUMTEXT('description')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('password');
            $table->boolean('status')->nullable()->default(true);
            $table->string('referred_by')->nullable()->default('#AFF001');
            $table->string('referral_code')->nullable();
            $table->integer('approve')->default('0');
            $table->rememberToken();
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
