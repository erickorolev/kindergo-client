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
            $table->string('childrens_age', 100)->comment('Возраст детей');
            $table->date('date')->comment('Дата отправления');
            $table->time('time')->comment('Время отправления');
            $table->integer('duration')->comment('Длительность маршрута в минутах');
            $table->decimal('distance')->comment('Дистанция маршрута в км');
            $table->integer('scheduled_wait_from')
                ->comment('Запланированное ожидание в точке Откуда в минутах');
            $table->integer('scheduled_wait_where')
                ->comment('Запланированное ожидание в точке Куда в минутах');
            $table
                ->enum('status', [
                    'Pending',
                    'Performed',
                    'Completed',
                    'Canceled',
                ])
                ->default('Pending')->comment('Статус');
            $table->boolean('bill_paid')->comment('Оплачен ли счёт');
            $table->text('description')->comment('Описание');
            $table->text('parking_info')->comment('Информация о парковке');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Контакт');
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
        Schema::dropIfExists('timetables');
    }
}