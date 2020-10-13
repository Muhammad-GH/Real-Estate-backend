<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInvestProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invest_property', function (Blueprint $table) {
            $table->string('appartment_type')->nullable()->after('name');
            $table->string('location')->nullable()->after('name');
            $table->string('invest_price')->nullable()->after('selling_price');
            $table->string('target_price')->nullable()->after('selling_price');
            $table->string('image')->nullable()->after('document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invest_property', function (Blueprint $table) {
            $table->dropColumn('appartment_type');
            $table->dropColumn('location');
            $table->dropColumn('invest_price');
            $table->dropColumn('target_price');
            $table->dropColumn('image');
        });
    }
}
