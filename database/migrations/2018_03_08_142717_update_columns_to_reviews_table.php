<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function ($table) {
            $table->integer('food_rate')->change();
            $table->integer('place_rate')->change();
            $table->integer('service_rate')->change();
            $table->text('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function ($table) {
            $table->float('food_rate')->change();
            $table->float('place_rate')->change();
            $table->float('service_rate')->change();
            $table->text('content')->change();
        });
    }
}
