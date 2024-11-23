<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonalSeeder extends Seeder
{
    public function run()
    {
        $personals = [
            [
                'nombre' => 'Juan Pérez',
                'telefono' => '987654321',
                'email' => 'juan.perez@example.com',
                'direccion' => 'Av. Arequipa 123, Lima',
                'dni' => '12345678',
                'cargo' => 'Mozo',
                'fecha_contrato' => '2023-01-15',
                'sueldo' => 1500.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
            [
                'nombre' => 'María López',
                'telefono' => '965874123',
                'email' => 'maria.lopez@example.com',
                'direccion' => 'Jr. Trujillo 456, Trujillo',
                'dni' => '87654321',
                'cargo' => 'Repartidor',
                'fecha_contrato' => '2023-02-20',
                'sueldo' => 1800.00,
                'licencia' => 'B123456',
                'vehiculo' => 'Moto',
            ],
            [
                'nombre' => 'Carlos Fernández',
                'telefono' => '912345678',
                'email' => 'carlos.fernandez@example.com',
                'direccion' => 'Calle Miraflores 789, Cusco',
                'dni' => '45678912',
                'cargo' => 'Otro',
                'fecha_contrato' => '2023-03-10',
                'sueldo' => 1600.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
            [
                'nombre' => 'Ana Morales',
                'telefono' => '924567890',
                'email' => 'ana.morales@example.com',
                'direccion' => 'Av. Grau 321, Piura',
                'dni' => '78912345',
                'cargo' => 'Repartidor',
                'fecha_contrato' => '2023-04-05',
                'sueldo' => 2000.00,
                'licencia' => 'C789654',
                'vehiculo' => 'Auto',
            ],
            [
                'nombre' => 'Luis Sánchez',
                'telefono' => '932156789',
                'email' => 'luis.sanchez@example.com',
                'direccion' => 'Jr. Ayacucho 987, Arequipa',
                'dni' => '32165487',
                'cargo' => 'Mozo',
                'fecha_contrato' => '2023-05-12',
                'sueldo' => 1400.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
            [
                'nombre' => 'Sofía Rojas',
                'telefono' => '941236578',
                'email' => 'sofia.rojas@example.com',
                'direccion' => 'Av. Primavera 456, Chiclayo',
                'dni' => '65478932',
                'cargo' => 'Repartidor',
                'fecha_contrato' => '2023-06-18',
                'sueldo' => 2200.00,
                'licencia' => 'D123987',
                'vehiculo' => 'Moto Navi Blanca',
            ],
            [
                'nombre' => 'Diego Torres',
                'telefono' => '952341678',
                'email' => 'diego.torres@example.com',
                'direccion' => 'Calle Lima 111, Ica',
                'dni' => '98732145',
                'cargo' => 'Otro',
                'fecha_contrato' => '2023-07-23',
                'sueldo' => 1700.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
            [
                'nombre' => 'Carmen Vega',
                'telefono' => '967123456',
                'email' => 'carmen.vega@example.com',
                'direccion' => 'Av. Salaverry 789, Puno',
                'dni' => '21436587',
                'cargo' => 'Mozo',
                'fecha_contrato' => '2023-08-09',
                'sueldo' => 1300.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
            [
                'nombre' => 'Fernando Rivera',
                'telefono' => '956214387',
                'email' => 'fernando.rivera@example.com',
                'direccion' => 'Jr. Amazonas 222, Huancayo',
                'dni' => '43216789',
                'cargo' => 'Repartidor',
                'fecha_contrato' => '2023-09-01',
                'sueldo' => 1900.00,
                'licencia' => 'E789456',
                'vehiculo' => 'Moto Navi Negra',
            ],
            [
                'nombre' => 'Laura Castillo',
                'telefono' => '951726384',
                'email' => 'laura.castillo@example.com',
                'direccion' => 'Calle Pizarro 888, Tacna',
                'dni' => '32187965',
                'cargo' => 'Mozo',
                'fecha_contrato' => '2023-10-15',
                'sueldo' => 1500.00,
                'licencia' => null,
                'vehiculo' => null,
            ],
        ];

        foreach ($personals as $personalData) {
            // Crear un usuario asociado para cada personal
            $user = User::create([
                'name' => $personalData['nombre'],
                'email' => $personalData['email'],
                'password' => Hash::make($personalData['dni']), // Contraseña igual al DNI
            ]);

            // Crear el personal
            Personal::create(array_merge($personalData, ['usuario_id' => $user->id]));
        }
    }
}
