<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->string('type')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('personal_id')->nullable();
            $table->string('citizen')->nullable();
            $table->string('investment_size')->nullable();
            $table->string('authentication')->nullable();
            $table->string('card_id')->nullable();
            $table->string('nomination_day')->nullable();
            $table->string('nomination_authority')->nullable();
            $table->boolean('checked_investment_case')->default(false);
            $table->boolean('terms_use')->default(false);
            $table->boolean('risks_investment')->default(false);
            $table->boolean('agree_all')->default(false);

            $table->timestamps();
        });

        Schema::table('user_detail', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_detail');
    }
}
