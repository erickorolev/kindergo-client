<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 190)->comment('Имя');
            $table->string('lastname', 190)->comment('Фамилия');
            $table->string('middle_name', 190)->nullable()->comment('Отчество');
            $table->date('birthday')->comment('Дата рождения');
            $table
                ->enum('gender', ['Male', 'Female', 'Other'])
                ->default('Other')->comment('Пол');
            $table->string('phone', 20)->comment('Телефон');
            $table->text('imagename')->nullable()->comment('Фотография');
            $table->string('otherphone', 20)->nullable()->comment('Другой телефон');
            $table->string('crmid', 100)->nullable()->comment('ID in Vtiger');
            $table->string('assigned_user_id', 100)->default('19x1')->comment('Owner in Vtiger');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
}
