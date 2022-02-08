<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->string('referred_by')->nullable()->default('#AFF001');
            $table->integer('affiliate_payment')->nullable();
            $table->string('order_code')->nullable();
            $table->string('status')->default('pending');
            $table->integer('product_price')->nullable();
            $table->integer('shipping_price')->nullable();
            $table->integer('shipping_time')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('police_station')->nullable();
            $table->string('district')->nullable();
            $table->MEDIUMTEXT('description')->nullable();
            $table->integer('shipping_id')->nullable();
            $table->string('payment')->nullable();
            $table->string('transection_code')->nullable();
            $table->string('cash_shipping_payment')->nullable();
            $table->string('cash_shipping_code')->nullable();
            $table->boolean('order_completed')->default(false);
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
        Schema::dropIfExists('order_tbl');
    }
}
