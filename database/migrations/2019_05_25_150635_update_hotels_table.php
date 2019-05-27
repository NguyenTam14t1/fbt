<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->integer('rating')->nullable();
            $table->string('website')->nullable();
            $table->dropColumn('information');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('information')->nullable();
            $table->dropColumn('phone');
            $table->dropColumn('rating');
            $table->dropColumn('website');
        });
    }
}
