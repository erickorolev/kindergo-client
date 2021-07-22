<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('attendants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 190)->comment('Имя');
            $table->string('lastname', 190)->comment('Фамилия');
            $table->string('middle_name', 190)->nullable()->comment('Отчество');
            $table->string('phone', 20)->comment('Телефон');
            $table->text('resume')->comment('Анкета');
            $table->string('car_model', 190)->comment('Марка автомобиля');
            $table->string('car_year', 50)->comment('Год автомобиля');
            $table->text('imagename')->nullable()->comment('Фотография');
            $table->string('email', 100)->nullable()->comment('Адрес электронной почты');
            $table
                ->enum('gender', ['Male', 'Female', 'Other'])
                ->default('Other')->comment('Пол');
            $table->string('crmid', 100)->nullable()->comment('ID in Vtiger');

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
        Schema::dropIfExists('attendants');
    }
}
