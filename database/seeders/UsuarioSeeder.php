<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {

            Usuario::factory()->create([
                'tipo' => fake()->randomElement([
                    'CLIENTE',
                    'FUNCIONARIO',
                ]),
            ]);
        }
    }
}
