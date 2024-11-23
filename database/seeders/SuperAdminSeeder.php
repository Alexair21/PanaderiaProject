<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Cliente;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario Super Admin
        $usuarioAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $rolAdmin = Role::firstOrCreate(['name' => 'Super Admin']);

        $permisos = Permission::pluck('id','id')->all();

        $rolAdmin->syncPermissions($permisos);

        $usuarioAdmin->assignRole($rolAdmin->id);

        // Crear permisos específicos para barista y cajero si no existen
        $permisoBarista = Permission::firstOrCreate(['name' => 'Acciones-barista']);
        $permisoCajero = Permission::firstOrCreate(['name' => 'Acciones-cajero']);
        $permisoCliente = Permission::firstOrCreate(['name' => 'Acciones-cliente']);
        $permisoMesero = Permission::firstOrCreate(['name' => 'Acciones-mesero']);

        // Crear el usuario Mesero
        $usuarioMesero = User::create([
            'name' => 'Mesero',
            'email' => 'mesero@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $rolMesero = Role::firstOrCreate(['name' => 'Mesero']);
        $rolMesero->givePermissionTo($permisoMesero);
        $usuarioMesero->assignRole($rolMesero->id);

        // Crear el usuario Cajero
        $usuarioCajero = User::create([
            'name' => 'Cajero',
            'email' => 'cajero@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $rolCajero = Role::firstOrCreate(['name' => 'Cajero']);
        $rolCajero->givePermissionTo($permisoCajero);

        $usuarioCajero->assignRole($rolCajero->id);

        //crear el rol cliente
        $rolCliente = Role::firstOrCreate(['name' => 'Cliente']);
        $rolCliente->givePermissionTo($permisoCliente);
    }
}
