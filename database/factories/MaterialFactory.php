<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Materia>
 */
class MaterialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_material' => fake()->randomElement([
                'Linha de algodão',
                'Lã',
                'Barbante',
                'Agulha de crochê',
                'Fio de malha',
                'Botão',
                'Fita de cetim',
                'Miçanga',
            ]),

            'marca_material' => fake()->randomElement([
                'Círculo',
                'Pingouin',
                'EuroRoma',
                'Cisne',
                'Sem marca',
            ]),

            'tipo_material' => fake()->randomElement([
                'Linha',
                'Fio',
                'Agulha',
                'Acessório',
                'Decoração',
            ]),

            'valor_unitario' => fake()->randomFloat(2, 1, 150),

            'qtd_estoque' => fake()->numberBetween(0, 500),
        ];
    }
}