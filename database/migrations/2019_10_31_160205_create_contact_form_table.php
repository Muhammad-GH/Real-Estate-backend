<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_form', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type');
            
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('subject')->nullable();
            $table->text('message')->nullable();

            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('appartment_min_size')->nullable();
            $table->string('appartment_max_size')->nullable();
            $table->string('built_year')->nullable();
            $table->string('property_type')->nullable();
            $table->string('appartment_min_price')->nullable();
            $table->string('appartment_max_price')->nullable();
            $table->string('no_rooms')->nullable();
            $table->string('condition')->nullable();
            $table->string('apartment_size')->nullable();
            $table->text('additional_requests')->nullable();
            $table->text('additional_selection')->nullable();
            $table->string('appartment_photo')->nullable();
            
            $table->string('link_sale')->nullable();
            $table->string('attach_sale')->nullable();

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
        Schema::dropIfExists('contact_form');
    }
}
