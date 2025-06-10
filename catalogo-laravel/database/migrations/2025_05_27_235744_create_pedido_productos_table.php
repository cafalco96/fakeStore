<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->onDelete('cascade'); // Relacion uno a muchos, un pedido puede tener muchos productos
            $table->foreignId('producto_id')
                ->constrained('productos')
                ->onDelete('cascade'); // Relacion uno a muchos, un producto puede estar en muchos pedidos
            $table->integer('cantidad'); // Cantidad del producto en el pedido
            $table->decimal('precio_unitario', 8, 2); // Precio del producto en el momento del pedido
            $table->decimal('subtotal', 8, 2); // Subtotal del producto (cantidad * precio)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_productos');
    }
};
