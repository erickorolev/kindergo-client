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
                ->string('type_payment', 100)
                ->default('Online payment')->comment('Вид оплаты');
            $table->bigInteger('amount')->comment('Сумма в копейках');
            $table
                ->string('spstatus', 100)
                ->default('Scheduled')->comment('Статус');
            $table->unsignedBigInteger('user_id')->comment('Контакт');
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
        Schema::dropIfExists('payments');
    }
}
