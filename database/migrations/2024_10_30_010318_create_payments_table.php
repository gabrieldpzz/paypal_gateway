<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id', 255);
            $table->string('payer_id', 255);
            $table->string('payer_email', 255);
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('recipient_name', 100)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('currency', 10)->nullable();
            $table->string('payment_state', 50)->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->string('transaction_state', 50)->nullable();
            $table->decimal('transaction_fee', 10, 2)->nullable();
            $table->dateTime('create_time')->nullable();
            $table->dateTime('update_time')->nullable();
            $table->string('payment_mode', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
