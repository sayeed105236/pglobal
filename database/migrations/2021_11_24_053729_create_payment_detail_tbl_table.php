<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_detail_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('gateway')->nullable();
            $table->integer('phone')->nullable();
            $table->string('account_type')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_branch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_detail_tbl');
    }
}
