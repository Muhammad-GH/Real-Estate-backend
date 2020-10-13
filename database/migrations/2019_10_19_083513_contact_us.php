<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
             
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();

            $table->boolean('viewed')->default(0);
            $table->boolean('replied')->default(0);

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
        Schema::dropIfExists('contact_us');
    }
}
