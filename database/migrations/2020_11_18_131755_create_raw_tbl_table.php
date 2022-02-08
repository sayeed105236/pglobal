<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('section')->nullable();
            $table->integer('value')->nullable();
            $table->string('image')->nullable();
            $table->TEXT('title')->nullable();
            $table->MEDIUMTEXT('description')->nullable();
            $table->string('url')->nullable();
            $table->string('btn')->nullable();
            $table->string('layout')->nullable();
            $table->string('category')->nullable();
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
        Schema::dropIfExists('raw_tbl');
    }
}
