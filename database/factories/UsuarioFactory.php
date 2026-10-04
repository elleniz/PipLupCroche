<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        return [
            'nome' => fake('pt_BR')->name(),

            'cpf' => fake('pt_BR')
                ->unique()
                ->numerify('###.###.###-##'),

            'telefone' => fake('pt_BR')
                ->numerify('(##) #####-####'),

            'email' => fake('pt_BR')
                ->unique()
                ->safeEmail(),

            'endereco' => fake('pt_BR')->address(),

            'data_nascimento' => fake()->date(),

            'tipo' => fake()->randomElement([
                'CLIENTE',
                'FUNCIONARIO',
            ]),
        ];
    }
}

