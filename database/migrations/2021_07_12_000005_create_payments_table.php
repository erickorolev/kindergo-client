<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('pay_date')->comment('Дата платежа');
            $table
                ->enum('type_payment', ['Online payment', 'Bank payment'])
                ->default('Online payment')->comment('Вид оплаты');
            $table->bigInteger('amount')->comment('Сумма в копейках');
            $table
                ->enum('spstatus', [
                    'Scheduled',
                    'Canceled',
                    'Delayed',
                    'Executed',
                ])
                ->default('Scheduled')->comment('Статус');
            $table->unsignedBigInteger('user_id')->comment('Контакт');
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
        Schema::dropIfExists('payments');
    }
}
