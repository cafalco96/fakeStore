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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade'); // Relacion uno a muchos, un usuario puede tener muchos pedidos
            $table->foreignId('direccion_id')
                ->constrained('direcciones')
                ->onDelete('cascade'); // Relacion uno a muchos, un pedido puede tener una direccion
            $table->decimal('total', 8, 2); // Total del pedido
            $table->string('estado')->default('pendiente'); // pendiente, entregado, cancelado
            $table->dateTime('fecha_pedido')->useCurrent(); // Fecha y hora del pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
