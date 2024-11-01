<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable(); // ID de PayPal u otro proveedor
            $table->unsignedBigInteger('user_id'); // Usuario que realizó la compra
            $table->decimal('total', 10, 2); // Total de la compra
            $table->string('status'); // Estado de la compra (ej. 'completado')
            $table->timestamps();

            // Relación con la tabla de usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // ID de la orden
            $table->unsignedBigInteger('product_id'); // ID del producto
            $table->integer('quantity'); // Cantidad de productos comprados
            $table->decimal('price', 10, 2); // Precio unitario del producto
            $table->timestamps();

            // Relaciones
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
