<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; // Add this line

class SeederTablePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //Operaciones sobre la tabla roles

            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre la tabla clientes
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'borrar-cliente',

            'Acciones-cliente',
            'Acciones-barista',
            'Acciones-cajero',

        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }

    }
}
