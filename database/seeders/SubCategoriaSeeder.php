<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategoria;

class SubCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcatedorias = [
            ['nombre' => 'Sopa', 'descripcion' => 'Platos de sopas variadas para iniciar la comida', 'estado' => true],
            ['nombre' => 'Segundo', 'descripcion' => 'Platos principales del menú diario', 'estado' => true],
            ['nombre' => 'Plato a la carta', 'descripcion' => 'Selección de platos especiales a la carta', 'estado' => true],
            ['nombre' => 'Bebidas', 'descripcion' => 'Bebidas frías y calientes para acompañar', 'estado' => true],
            ['nombre' => 'Jugos', 'descripcion' => 'Jugos naturales y batidos frescos', 'estado' => false],
            ['nombre' => 'Sandwiches', 'descripcion' => 'Sándwiches y bocadillos variados', 'estado' => false],
            ['nombre' => 'Otros', 'descripcion' => 'Otros productos y acompañamientos adicionales', 'estado' => false],
        ];

        foreach ($subcatedorias as $subcategoria) {
            SubCategoria::create($subcategoria);
        }
    }
}
