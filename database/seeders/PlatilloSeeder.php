<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platillo;

class PlatilloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platillos = [
            [
                'nombre' => 'Arroz a la cubana',
                'descripcion' => 'Un platillo clásico de arroz con plátano y huevo.',
                'precio' => 12.00,
                'imagen' => 'imagenes/Arroz a la cubana.jpeg', // Ruta en public/imagenes
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Arroz con pato',
                'descripcion' => 'Arroz verde con pato a la norteña.',
                'precio' => 18.00,
                'imagen' => 'imagenes/Arroz con pato.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Arroz con pollo',
                'descripcion' => 'Arroz verde con pollo y salsa criolla.',
                'precio' => 15.00,
                'imagen' => 'imagenes/Arroz con pollo.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Cabrito norteño',
                'descripcion' => 'Cabrito tierno al estilo norteño.',
                'precio' => 25.00,
                'imagen' => 'imagenes/Cabrito norteño.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Cau cau',
                'descripcion' => 'Un plato criollo de mondongo y papas.',
                'precio' => 13.00,
                'imagen' => 'imagenes/Cau cau.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Chuleta',
                'descripcion' => 'Chuleta de cerdo acompañada de ensalada y papas fritas.',
                'precio' => 16.00,
                'imagen' => 'imagenes/Chuleta.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Segundo
                'estado' => true,
            ],
            [
                'nombre' => 'Estofado de res',
                'descripcion' => 'Carne de res guisada con verduras.',
                'precio' => 14.00,
                'imagen' => 'imagenes/Estofado de res.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Segundo
                'estado' => true,
            ],
            [
                'nombre' => 'Guiso de pollo',
                'descripcion' => 'Un guiso de pollo con papas y zanahorias.',
                'precio' => 12.00,
                'imagen' => 'imagenes/Guiso de pollo.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Segundo
                'estado' => true,
            ],
            [
                'nombre' => 'Hígado encebollado',
                'descripcion' => 'Hígado de res con cebolla y especias.',
                'precio' => 10.00,
                'imagen' => 'imagenes/Higado encebollado.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Segundo
                'estado' => true,
            ],
            [
                'nombre' => 'Mondonguito',
                'descripcion' => 'Mondongo en trozos con papas y especias.',
                'precio' => 11.00,
                'imagen' => 'imagenes/Mondonguito.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Parrilla',
                'descripcion' => 'Selección de carnes a la parrilla.',
                'precio' => 30.00,
                'imagen' => 'imagenes/Parrilla.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Pescado frito',
                'descripcion' => 'Filete de pescado frito con ensalada.',
                'precio' => 15.00,
                'imagen' => 'imagenes/Pescado frito.jpg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Pollada',
                'descripcion' => 'Pollo frito con papas y ensalada.',
                'precio' => 13.00,
                'imagen' => 'imagenes/Pollada.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Pollo broaster',
                'descripcion' => 'Pollo crujiente estilo broaster.',
                'precio' => 14.00,
                'imagen' => 'imagenes/Pollo broaster.jpeg',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Shambar',
                'descripcion' => 'Preparado con una deliciosa mezcla de menestras, carne de cerdo, hierbas aromáticas y ají, servido con crujiente chicharrón y trigo. Perfecto para los lunes.',
                'precio' => 19.00,
                'imagen' => 'imagenes/shambar.png',
                'categoria_id' => 2,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Caldo de gallina',
                'descripcion' => 'Elaborado con gallina tierna, fideos, huevo duro y un toque de hierbas aromáticas, ideal para disfrutar en cualquier momento del día.',
                'precio' => 15.00,
                'imagen' => 'imagenes/CaldoGallina.jpg',
                'categoria_id' => 3,
                'subcategoria_id' => 3, // Plato a la carta
                'estado' => true,
            ],
            [
                'nombre' => 'Chicha morada - Jarra',
                'descripcion' => 'Refrescante bebida peruana hecha a base de maíz morado, frutas como piña y manzana, y especias aromáticas, perfecta para acompañar cualquier comida.',
                'precio' => 10.00,
                'imagen' => 'imagenes/chicha.jfif',
                'categoria_id' => 4,
                'subcategoria_id' => 4,
                'estado' => true,
            ],
            [
                'nombre' => 'Jugo de papaya',
                'descripcion' => 'Bebida natural, dulce y refrescante, rica en vitaminas y perfecta para comenzar el día o acompañar una comida saludable.',
                'precio' => 5.00,
                'imagen' => 'imagenes/jugopapaya.jpg',
                'categoria_id' => 1,
                'subcategoria_id' => 4,
                'estado' => true,
            ],
            [
                'nombre' => 'Jugo de fresa',
                'descripcion' => 'Deliciosa bebida natural, dulce y refrescante, llena de antioxidantes y perfecta para disfrutar en cualquier momento del día.',
                'precio' => 5.00,
                'imagen' => 'imagenes/jugofresa.jfif',
                'categoria_id' => 1,
                'subcategoria_id' => 4,
                'estado' => true,
            ],
        ];

        foreach ($platillos as $platillo) {
            Platillo::create($platillo);
        }
    }
}
