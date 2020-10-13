<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_category', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('category_name');
            $table->unsignedBigInteger('category_parent_id')->nullable();
            $table->foreign('category_parent_id')->references('category_id')->on('pro_category');
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
        Schema::dropIfExists('pro_category');
    }
}
