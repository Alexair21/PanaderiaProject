<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un cliente de prueba
        $cliente = [

            [
                'nombre' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'telefono' => '123456789',
                'direccion' => 'Lima',
            ],
            [
                'nombre' => 'Barista',
                'email' => 'barista@gmial.com',
                'telefono' => '123456789',
                'direccion' => 'Lima',
            ],
            [
                'nombre' => 'Cajero',
                'email' => 'cajero@gmail.com',
                'telefono' => '123456789',
                'direccion' => 'Lima',
            ],


        ];

        foreach ($cliente as $cliente) {
            Cliente::create($cliente);
        }
    }
}
