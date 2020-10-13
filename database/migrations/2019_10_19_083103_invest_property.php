<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('name')->nullable();
            $table->text('details');

            $table->string('bathroom')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('painting')->nullable();
            $table->string('flooring')->nullable();
            $table->string('interior_design')->nullable();

            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('selling_price')->nullable();
            $table->string('profit')->nullable();
            $table->unsignedInteger('net_return')->nullable();
            $table->unsignedInteger('capital_growth')->nullable();
            $table->unsignedInteger('liquidation')->nullable();
            
            $table->string('broker_fee')->nullable();
            $table->string('taxes')->nullable();
            $table->string('monthly_cost')->nullable();
            
            $table->string('document')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('invest_property');
    }
}
