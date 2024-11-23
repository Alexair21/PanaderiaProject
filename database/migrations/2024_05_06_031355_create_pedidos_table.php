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
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nombre');
            $table->string('estado')->default('pendiente');
            $table->string('direccion')->nullable();
            $table->string('MetodoPago');
            $table->string('FechaPedido');
            $table->string('TipoPedido');

            // Nueva columna para asociar pedidos a mesas
            $table->foreignId('mesa_id')->nullable()->constrained('mesas')->onDelete('set null');

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
