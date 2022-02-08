<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('price')->nullable();//not in use
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_tbl');
    }
}
