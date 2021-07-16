<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Откуда');
            $table->string('where_address')->comment('Куда');
            $table->date('date')->comment('Дата отправления');
            $table->time('time')->comment('Время отправления');
            $table->integer('childrens')->default(0)->comment('Количество детей');
            $table
                ->enum('status', [
                    'Appointed',
                    'Performed',
                    'Completed',
                    'Canceled',
                ])
                ->default('Appointed')->comment('Статус');
            $table->unsignedBigInteger('attendant_id')->nullable()->comment('Сопровождающий');
            $table->unsignedBigInteger('timetable_id')->comment('Расписание');
            $table->integer('scheduled_wait_where')
                ->comment('Незапланированное время ожидания в точке Куда');
            $table->integer('sheduled_wait_from')
                ->comment('Незапланированное время ожидания в точке Откуда');
            $table->integer('parking_cost')->comment('Стоимость парковки');
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
        Schema::dropIfExists('trips');
    }
}