<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactFormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_form', function (Blueprint $table) {
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
        });

    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('contact_form', function (Blueprint $table) {
            $table->dropColumn('approved');
            $table->dropColumn('approved_by');
        });
    }
}
