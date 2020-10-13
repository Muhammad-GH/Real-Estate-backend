<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('short_description');
            $table->text('description');
            $table->text('tags');
            $table->unsignedBigInteger('blog_category_id');
            $table->string('image')->nullable();
            

            $table->softDeletes();
            
            $table->timestamps();
        });

        Schema::table('blog', function (Blueprint $table) {
            $table->foreign('blog_category_id')->references('id')->on('blog_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
