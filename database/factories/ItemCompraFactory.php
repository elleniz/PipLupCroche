<?php

namespace Database\Factories;

use App\Models\ItemCompra;
use App\Models\Compra;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemCompraFactory extends Factory
{
    protected $model = ItemCompra::class;

    public function definition(): array
    {
        return [
            'compra_id' => Compra::factory(),
            'material_id' => Material::factory(),
            'quantidade' => fake()->numberBetween(1, 20),
        ];
    }
}
