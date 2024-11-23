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
        Schema::create('platillos', function (Blueprint $table) {
            $table->id();
            $table ->string('nombre');
            $table ->string('descripcion');
            $table ->float('precio');
            $table ->string('imagen');
            $table ->boolean('estado')->default(false);
            $table ->boolean('destacado')->default(false);

            //clave foranea
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->bigInteger('subcategoria_id')->unsigned();
            $table->foreign('subcategoria_id')->references('id')->on('sub_categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platillos');
    }
};
