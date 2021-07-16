<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Отображаемое имя контакта');
            $table->string('email')->unique()->comment('Адрес электронной почты');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->text('imagename')->nullable()->comment('Фотография');
            $table->string('firstname', 190)->comment('Имя');
            $table->string('lastname', 190)->comment('Фамилия');
            $table->string('middle_name', 190)->nullable()->comment('Отчество');
            $table->string('phone', 20)->comment('Телефон');
            $table
                ->enum('attendant_gender', ['Male', 'Female', 'No matter'])
                ->default('No matter')->comment('Предпочитаемый пол сопровождающего');
            $table->string('otherphone', 50)->nullable()->comment('Другой телефон');
            $table->string('crmid', 100)->nullable()->unique()->comment('ID in Vtiger');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
