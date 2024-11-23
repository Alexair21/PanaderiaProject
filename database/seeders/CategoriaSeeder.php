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
            ['nombre' => 'Desayuno',
            'estado' => true],
            ['nombre' => 'Almuerzo',
            'estado' => true],
            ['nombre' => 'Cena',
            'estado' => true],
            ['nombre' => 'Bebidas',
            'estado' => true],
        ];

        // Insertar cada categoría en la base de datos
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
