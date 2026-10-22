<?php

namespace Database\Factories;

use App\Models\ItemVenda;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemVendaFactory extends Factory
{
    protected $model = ItemVenda::class;

    public function definition(): array
    {
        return [
            'venda_id' => Venda::factory(),
            'produto_id' => Produto::factory(),
            'quantidade' => fake()->numberBetween(1, 20),
        ];
    }
}
