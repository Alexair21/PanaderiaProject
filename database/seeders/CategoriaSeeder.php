<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de categorías para insertar
        $categorias = [
            ['nombre' => 'Cafés', 'descripcion' => 'Bebidas de café de diferentes tipos'],
            ['nombre' => 'Tés', 'descripcion' => 'Variedad de tés e infusiones'],
            ['nombre' => 'Pasteles', 'descripcion' => 'Pasteles y tartas frescas'],
            ['nombre' => 'Sándwiches', 'descripcion' => 'Sándwiches y bocadillos variados'],
            ['nombre' => 'Jugos', 'descripcion' => 'Jugos naturales y batidos'],
        ];

        // Insertar cada categoría en la base de datos
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
