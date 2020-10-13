<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_form', function (Blueprint $table) {
             $table->integer('construction_year_min')->nullable()->after('appartment_max_size');
             $table->integer('construction_year_max')->nullable()->after('appartment_max_size');
             $table->integer('rooms_min')->nullable()->after('appartment_max_size');
             $table->integer('rooms_max')->nullable()->after('appartment_max_size');
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
            //
            $table->dropColumn('construction_year_min');
            $table->dropColumn('construction_year_max');
            $table->dropColumn('rooms_min');
            $table->dropColumn('rooms_max');
        });
    }
}
