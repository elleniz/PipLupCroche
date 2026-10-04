<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();

        foreach ($categorias as $categoria) {
            Produto::factory()->create([
                'categoria_id' => $categoria->id,
            ]);
        }
    }
}

