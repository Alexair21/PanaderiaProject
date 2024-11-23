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
        Schema::create('mesas', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->integer('numero'); // Número secuencial de la mesa
            $table->foreignId('sala_id') // Relación con la tabla salas
                  ->constrained('salas')
                  ->onDelete('cascade'); // Si se elimina la sala, se eliminan sus mesas
            $table->string('estado')->default('disponible'); // Estado de la mesa
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
