<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'usuario_id' => fake()->numberBetween(1, 10),
            
            'data' => fake()->date(),

            'valor_total' => fake()->randomFloat(2, 1, 10),

            'status' => $this->faker->randomElement([
                'PENDENTE',
                'PAGO',
                'EM_PRODUCAO',
                'ENVIADO',
                'ENTREGUE',
            ]),

            'prazo_entrega' => fake()->date(),
        ];
    }
}