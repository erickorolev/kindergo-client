<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table
                ->foreign('attendant_id')
                ->references('id')
                ->on('attendants')
                ->onUpdate('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE');

            $table
                ->foreign('timetable_id')
                ->references('id')
                ->on('timetables')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropForeign(['attendant_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['timetable_id']);
        });
    }
}
