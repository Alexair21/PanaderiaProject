<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de productos para insertar
        $productos = [

            //cafes
            [
                'nombre' => 'Mocha blanco Frappuccino',
                'descripcion' => 'Frappuccino de café mezclado con leche, mocha blanco y decorado con crema batida.',
                'stock' => 25,
                'precio' => 15.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/MOCHA_BLANCO_FRAPP_V2.png',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Cookies & Creme Frappuccino Alto',
                'descripcion' => 'Clásico frappuccino de leche batido con mocha blanco y gotas sabor a chocolate y topping de galletas trozadas.',
                'stock' => 25,
                'precio' => 16.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/COOKIES_CREAM_FRAPPUCCINO_202303061805104998.PNG',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Chocolate Cookies & Creme Frappuccino',
                'descripcion' => 'Clásico frappuccino de leche batido con mocha y topping de galletas trozadas.',
                'stock' => 25,
                'precio' => 16.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/CHOCOLATE_COOKIES_CREAM_FRAPPUCCINO_202303061807246058.PNG',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Ultimate Caramel Frappuccino',
                'descripcion' => 'Versión renovada de nuestro clásico Caramel Frappuccino, con doble crema batida y extra de caramelo.',
                'stock' => 25,
                'precio' => 16.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/ULTIMATE_CARAMEL_FRAPP_V2.png',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Mocha Frappuccino',
                'descripcion' => 'Frappuccino de café mezclado con leche y jarabe de mocha, decorado con crema batida.',
                'stock' => 25,
                'precio' => 15.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/MOCHA_FRAPP_V3.png',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Algarrobina Frappuccino',
                'descripcion' => 'Nuestro frappuccino peruano. Delicioso jarabe de algarrobina mezclada con café, leche y mocha.',
                'stock' => 25,
                'precio' => 15.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/ALGARROBINA_FRAPP_V2.png',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Americano',
                'descripcion' => 'Café Espresso de cuerpo completo con agua caliente. ',
                'stock' => 25,
                'precio' => 9.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/AMERICANO_V2.png',
                'categoria_id' => 1,
            ],
            [
                'nombre' => 'Latte',
                'descripcion' => 'Café Espresso de cuerpo completo mezclado con leche vaporizada.',
                'stock' => 25,
                'precio' => 11.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/LATTE_V2.png',
                'categoria_id' => 1,
            ],

            //Tes
            [
                'nombre' => 'Té Chai Teavanna',
                'descripcion' => 'Té filtrante con especies como té negro, jengibre, pimienta, canela que ofrecen un sabor ligeramente picante.',
                'stock' => 25,
                'precio' => 9.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/TE_CHAI_TEAVANNA_V2.png',
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'Té Mint Citrus Teavanna',
                'descripcion' => 'Té verde filtrante con limón, verbena y menta. Sin endulzantes. ',
                'stock' => 25,
                'precio' => 9.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/TE_MINT_CITRUS_TEAVANNA_V2.png',
                'categoria_id' => 2,
            ],
            [
                'nombre' => 'Té Chamomile Teavanna Alto',
                'descripcion' => 'Té filtrante con escencia de manzanilla. Sin endulzantes. ',
                'stock' => 25,
                'precio' => 9.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/TE_CHAMOLINE_TEAVANNA_V2.png',
                'categoria_id' => 2,
            ],

            //pasteles
            [
                'nombre' => 'Keke de zanahoria',
                'descripcion' => 'Keke elaborado con harina, azucar, manteca, ralladura de zanahoria, trozos de pecanas y con frostry zona superior. ',
                'stock' => 25,
                'precio' => 9.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/KEKE_DE_ZANAHORIA_V2.png',
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Cheesecake de Chocolate',
                'descripcion' => 'Cheesecake con base de doble galleta de chocolate, crema sabor a vainilla, cubierto con cobertura bitter, decorado con crema chantilly, brownie y crema de avellanas. ',
                'stock' => 25,
                'precio' => 15.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/CHEESECAKE_DE_CHOCOLATE_V2.png',
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Cheesecake de Arándanos',
                'descripcion' => 'Cheesecake con base de galleta y couliz de fresa y arándanos. ',
                'stock' => 25,
                'precio' => 15.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/CHEESECAKE_DE_ARANDANOS_V2.png',
                'categoria_id' => 3,
            ],
            [
                'nombre' => 'Torta de chocolate',
                'descripcion' => 'Cheesecake con base de galleta y couliz de chocolate.',
                'stock' => 25,
                'precio' => 15.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/TORTA_DE_CHOCOLATE_V2.png',
                'categoria_id' => 3,
            ],

            //Sándwiches
            [
                'nombre' => 'Sandwich Pavita & queso',
                'descripcion' => 'Sándwich elaborado con pan tipo avena, jamón de pavita y queso cheddar.',
                'stock' => 25,
                'precio' => 13.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/SANDWICH_DE_PAVITA_Y_QUESO_V2.png',
                'categoria_id' => 4,
            ],

            [
                'nombre' => 'Sandwich Eggmont',
                'descripcion' => 'Croissant de mantequilla rellemo de huevos escalfados, mayonesa y trozos de tocino.',
                'stock' => 25,
                'precio' => 12.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/SANDWICH_EGGMONT_V2.png',
                'categoria_id' => 3,
            ],

            [
                'nombre' => 'Empanada de lomo',
                'descripcion' => 'Clásica empanada relleno de jugoso lomo en trozos, ají y cebolla cortada en juliana. ',
                'stock' => 25,
                'precio' => 9.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/EMPANADA_DE_LOMO_V2.png',
                'categoria_id' => 3,
            ],

            [
                'nombre' => 'Sandwich Chicken panino',
                'descripcion' => 'Sándwich elaborado en pan panini integral, con pollo deshilachado, apio picado, jamón de cerdo y queso. ',
                'stock' => 25,
                'precio' => 13.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/SANDWICH_CHICKEN_PANINO_V2.png',
                'categoria_id' => 3,
            ],

            [
                'nombre' => 'Sandwich Chicken ciabatta',
                'descripcion' => 'Sándwich elaborado con pan ciabatta, pollo deshilachado y mezclado con mayonesa y apio picado.',
                'stock' => 25,
                'precio' => 13.50,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/SANDWICH_CHICKEN_CIABATTA_V2.png',
                'categoria_id' => 3,
            ],

            //jugos
            [
                'nombre' => 'Jugo de Piña y Manzana',
                'descripcion' => 'Mezcla de jugos de piña, limón hierba buena y manzana prensado al frío.',
                'stock' => 25,
                'precio' => 13.00,
                'imagen' => 'https://www.starbucks.pe/Multimedia/productos/JUGO_DE_PI%C3%91A_Y_MANZANA_V2.png',
                'categoria_id' => 3,
            ],
            //[
                //'nombre' => 'Torta de chocolate',
                //'descripcion' => 'v',
                //'stock' => 25,
                //'precio' => 15.00,
                //'imagen' => 'v',
                //'categoria_id' => 3,
            //],
        ];

        // Insertar cada producto en la base de datos
        foreach ($productos as $producto) {
            Producto::create($producto);
        }

    }
}
