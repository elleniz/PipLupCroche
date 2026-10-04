<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Vaga>
 */
class VagaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'funcao' => fake()->randomElement([
                'Embalador',
                'Produtor',
                'Marketing',
                'Contabilidade',
            ]),

            'salario' => fake()->randomElement([
                1800.00,
                2000.00,
                2200.00,
                2500.00,
                2800.00,
                3000.00,
                3500.00,
            ]),

            'escala' => fake()->randomElement([
                '5x2',
                '6x1',
                '12x36',
                '4x3',
            ]),

            'jornada_trabalho' => fake()->randomElement([
                '4 horas por dia',
                '6 horas por dia',
                '8 horas por dia',
                '44 horas semanais',
            ]),

            'turno' => fake()->randomElement([
                'Manhã',
                'Tarde',
                'Noite',
                'Integral',
            ]),

            'tempo_profissao' => fake()->randomElement([
                '1 ano',
                '2 anos',
                '3 anos',
                '5 anos',
                '8 anos',
                '10 anos',
            ]),
        ];
    }
}