<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;
use App\Models\Usuario;
use App\Models\Produto;

class VendaSeeder extends Seeder
{
    public function run(): void
    {
        // Busca somente os clientes
        $usuarios = Usuario::where('tipo', 'CLIENTE')->get();

        // Busca os produtos cadastrados
        $produtos = Produto::all();

        // Se não houver produtos, não cria vendas vazios
        if ($produtos->isEmpty()) {
            return;
        }

        foreach ($usuarios as $usuario) {

            // Cria um venda para o cliente
            $venda = Venda::factory()->create([
                'usuario_id' => $usuario->id,
                'valor_total' => 0,
            ]);

            // Escolhe de 1 a 3 produtos aleatórios
            $quantidadeProdutos = rand(1, min(3, $produtos->count()));

            $produtosEscolhidos = $produtos
                ->random($quantidadeProdutos);

            $total = 0;

            // Adiciona os produtos ao venda
            foreach ($produtosEscolhidos as $produto) {

                $quantidade = rand(1, 3);

                $venda->produtos()->attach($produto->id, [
                    'quantidade' => $quantidade,
                ]);

                // Calcula o valor total da compra
                $total += $produto->preco * $quantidade;
            }

            // Atualiza o total do venda
            $venda->update([
                'valor_total' => $total,
            ]);
        }
    }
}
