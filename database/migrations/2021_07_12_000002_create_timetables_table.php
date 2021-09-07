<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 190)->comment('Откуда');
            $table->string('where_address')->comment('Куда');
            $table->integer('trips')->comment('Количество поездок');
            $table->integer('childrens')->comment('Количество детей');
            $table->string('childrens_age', 50)->comment('Возраст детей');
            $table->text('date')->nullable()->comment('Даты отправления');
            $table->time('time')->nullable()->comment('Время отправления');
            $table->integer('duration')->comment('Длительность маршрута в минутах');
            $table->integer('insurances')->comment('Количество страховок');
            $table->decimal('distance')->comment('Дистанция маршрута в км');
            $table->integer('scheduled_wait_from')
                ->comment('Запланированное ожидание в точке Откуда в минутах');
            $table->integer('scheduled_wait_where')
                ->comment('Запланированное ожидание в точке Куда в минутах');
            $table
                ->string('status', 100)
                ->default('Pending')->comment('Статус');
            $table->boolean('bill_paid')->comment('Оплачен ли счёт');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('parking_info')->nullable()->comment('Информация о парковке');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Контакт');
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
        Schema::dropIfExists('timetables');
    }
}
