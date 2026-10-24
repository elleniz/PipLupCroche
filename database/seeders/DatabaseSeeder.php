<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        CategoriaSeeder::class,
        ProdutoSeeder::class,
        UsuarioSeeder::class,
        VagaSeeder::class,
        VendaSeeder::class,
        MaterialSeeder::class,
        CompraSeeder::class,
    ]);
    }
}