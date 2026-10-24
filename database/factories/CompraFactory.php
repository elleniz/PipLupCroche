<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'fornecedor' => fake()->company(),

            'data_compra' => fake()->date(),

            'valor_total' => fake()->randomFloat(2, 1, 10),

            'materiais' => fake()->randomElements(Material::all(), 3),
        ];
    }
}
