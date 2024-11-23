<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SeederTablePermissions::class);

        $this->call(SuperAdminSeeder::class);

        $this->call(CategoriaSeeder::class);

        $this->call(SubCategoriaSeeder::class);

        $this->call(ClienteSeeder::class);

        $this->call(PlatilloSeeder::class);

        $this->call(PersonalSeeder::class);
    }
}
