<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invest', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('invest_property_id');
            
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('investment_time')->nullable();
            $table->boolean('agree_terms')->default(false);

            $table->timestamps();
        });

        Schema::table('user_invest', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('user_invest', function (Blueprint $table) {
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
        Schema::dropIfExists('user_invest');
    }
}
