<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToChildUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_user', function (Blueprint $table) {
            $table
                ->foreign('child_id')
                ->references('id')
                ->on('children')
                ->onUpdate('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('child_user', function (Blueprint $table) {
            $table->dropForeign(['child_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
