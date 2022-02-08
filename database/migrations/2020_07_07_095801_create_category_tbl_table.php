<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_tbl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable();
            $table->string('name')->unique('slug');
            $table->string('icon')->nullable();
            $table->MEDIUMTEXT('description')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_tbl');
    }
}
