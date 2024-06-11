<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Precio;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //cafes

        // Array de precios para insertar
        $precios = [
            [
                'nombre' => 'Mediano',
                'precio' => 17.50,
                'producto_id' => 1,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 21.00,
                'producto_id' => 1,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 24.00,
                'producto_id' => 1,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 19.00,
                'producto_id' => 2,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 23.00,
                'producto_id' => 2,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 25.00,
                'producto_id' => 2,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 19.00,
                'producto_id' => 3,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 23.00,
                'producto_id' => 3,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 25.00,
                'producto_id' => 3,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 18.50,
                'producto_id' => 4,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 21.00,
                'producto_id' => 4,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 24.00,
                'producto_id' => 4,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 17.50,
                'producto_id' => 5,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 20.00,
                'producto_id' => 5,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 23.00,
                'producto_id' => 5,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 18.00,
                'producto_id' => 6,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 20.50,
                'producto_id' => 6,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 23.50,
                'producto_id' => 6,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 11.50,
                'producto_id' => 7,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 14.00,
                'producto_id' => 7,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 18.00,
                'producto_id' => 7,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 14.00,
                'producto_id' => 8,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 16.50,
                'producto_id' => 8,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 19.00,
                'producto_id' => 8,
            ],


            [
                'nombre' => 'Mediano',
                'precio' => 12.00,
                'producto_id' => 9,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 14.50,
                'producto_id' => 9,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 18.00,
                'producto_id' => 9,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 11.50,
                'producto_id' => 10,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 14.00,
                'producto_id' => 10,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 17.00,
                'producto_id' => 10,
            ],

            [
                'nombre' => 'Mediano',
                'precio' => 11.50,
                'producto_id' => 11,
            ],
            [
                'nombre' => 'Grande',
                'precio' => 14.00,
                'producto_id' => 11,
            ],
            [
                'nombre' => 'Extra-Grande',
                'precio' => 17.00,
                'producto_id' => 11,
            ],

        ];

        // Insertar cada precio en la base de datos
        foreach ($precios as $precio) {
            Precio::create($precio);
        }
    }
}
