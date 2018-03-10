<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('first_name')->after('user_id');
            $table->string('last_name')->after('first_name');
            $table->string('address')->after('last_name');
            $table->string('phone')->after('address');
            $table->string('identity_card')->after('phone');
            $table->text('requiments')->nullable()->after('identity_card');
            $table->integer('number_of_children')->after('requiments');
            $table->string('confirm_code')->after('times_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('number_of_children');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('identity_card');
            $table->dropColumn('requiments');
            $table->dropColumn('confirm_code');
        });
    }
}
