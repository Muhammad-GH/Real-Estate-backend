<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->string('name')->nullable();
            $table->text('details');

            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('size')->nullable();
            $table->string('rooms')->nullable();

            $table->unsignedInteger('price')->nullable();
            $table->string('manager_name')->nullable();
            $table->unsignedInteger('built_year')->nullable();
            $table->unsignedInteger('apartment_no')->nullable();
            $table->unsignedInteger('planned_renovation')->nullable();
            $table->unsignedInteger('done_renovation')->nullable();

            $table->string('land_ownership')->nullable();
            $table->string('land_area')->nullable();
            $table->string('heating_method')->nullable();

            $table->unsignedInteger('month_appartment_cost')->nullable();
            $table->unsignedInteger('month_appartment_capital')->nullable();
            $table->unsignedInteger('water_cost')->nullable();
            $table->unsignedInteger('other_appartment_cost')->nullable();

            $table->timestamps();
            $table->softDeletes();
            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
