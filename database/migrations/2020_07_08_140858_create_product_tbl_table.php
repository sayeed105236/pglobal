<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->float('affiliate_percentage')->nullable()->default('0');
            $table->MEDIUMTEXT('description')->nullable();
            $table->float('price')->nullable();
            $table->float('before_discount')->nullable();
            $table->integer('stock')->nullable();
            $table->string('stock_desc')->default("in");
            $table->string('main_image')->nullable();
            $table->text('image')->nullable();
            $table->string('category')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('approve')->default(false);
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
        Schema::dropIfExists('product_tbl');
    }
}
