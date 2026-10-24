<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\Material;

class CompraSeeder extends Seeder
{
    public function run(): void
    {
        $materiais = Material::all();

        //sem material sem compra
        if ($materiais->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 5; $i++) {

            $compra = Compra::create([
                'fornecedor' => fake()->company(),
                'data_compra' => fake()->date(),
                'valor_total' => 0,
            ]);

            $quantidadeMateriais = rand(
                1,
                min(3, $materiais->count())
            );

            $materiaisEscolhidos = $materiais
                ->random($quantidadeMateriais);

            $total = 0;

            // materiais adicionar
            foreach ($materiaisEscolhidos as $material) {

                $quantidade = rand(1, 3);

                $compra->materiais()->attach($material->id, [
                    'quantidade' => $quantidade,
                ]);

                $total += $material->valor_unitario * $quantidade;
            }

            $compra->update([
                'valor_total' => $total,
            ]);
        }
    }
}