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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('email');
            $table->string('direccion');
            $table->string('dni');
            $table->string('cargo');
            $table->string('fecha_contrato');
            $table->float('sueldo');
            $table->string('licencia')->nullable(); // Campo para licencia
            $table->string('vehiculo')->nullable(); // Campo para vehículo
            $table->enum('estado', ['Disponible', 'Ocupado'])->default('Disponible');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
