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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('telefono');
            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade'); // Relacion uno a muchos, un usuario puede tener muchas direcciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
