<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_auth_id')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('price')->nullable();
            $table->string('referred_by')->nullable()->default('#AFF001');
            $table->integer('affiliate_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail_tbl');
    }
}
