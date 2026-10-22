<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ProdutosMaisVendidosChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

            $produtosMaisVendidos = DB::table('item_pedido')
            ->join('produtos', 'produtos.id', '=', 'item_pedido.produto_id')
            ->select(
                'produtos.nome',
                DB::raw('SUM(item_pedido.quantidade) as total_vendido')
            )
            ->groupBy('produtos.id', 'produtos.nome')
            ->orderBy('total_vendido', 'desc')
            ->limit(10)
            ->get();

        $qtdVendida = [];
        $nomeProdutos = [];

        foreach ($produtosMaisVendidos as $item) {
            $nomeProdutos[] = $item->nome;
            $qtdVendida[] = (int) $item->total_vendido;
        }

        return (new LarapexChart)->pieChart()
            ->setTitle('Produtos mais Vendidos')
            ->setSubtitle('Top produtos por unidade vendida')
            ->addData($qtdVendida)
            ->setLabels($nomeProdutos)
            ->setColors([
                '#e7b9bd',
                '#d48c98',
                '#55003E',
                '#6d3f36',
                '#f3d8d9',
                '#813C52',
                '#986477',
            ]);
    }
}
