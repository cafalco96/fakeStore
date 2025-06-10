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
        Schema::create('carrito_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrito_id')
                ->constrained('carritos')
                ->onDelete('cascade'); // Relacion uno a muchos, un carrito puede tener muchos productos
            $table->foreignId('producto_id')
                ->constrained('productos')
                ->onDelete('cascade'); // Relacion uno a muchos, un producto puede estar en muchos carritos
            $table->integer('cantidad')->default(1); // Cantidad del producto en el carrito
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_productos');
    }
};
