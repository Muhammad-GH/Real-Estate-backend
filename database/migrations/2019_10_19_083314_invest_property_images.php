<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestPropertyImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_property_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('invest_property_id');
            $table->string('name');
            $table->string('type');
            
            $table->timestamps();
        });

        Schema::table('invest_property_images', function (Blueprint $table) {
            $table->foreign('invest_property_id')->references('id')->on('invest_property');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invest_property_images');
    }
}
