<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ValorGastoComprasChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $compras = DB::table('materiais')
            ->join('item_compra', 'materiais.id', '=', 'item_compra.material_id')
            ->selectRaw('materiais.nome_material, SUM(item_compra.quantidade * materiais.valor_unitario) as total')
            ->groupBy('materiais.id', 'materiais.nome_material')
            ->orderByDesc('total')
            ->get();

        $nomes = [];
        $valores = [];

        foreach ($compras as $compra) {
            $nomes[] = $compra->nome_material;
            $valores[] = (float) $compra->total;
        }

        return (new LarapexChart)->barChart()
            ->setTitle('Gastos por Material')
            ->setSubtitle('Valor total gasto com cada material')
            ->addData($valores, 'Valor gasto (R$)')
            ->setXAxis($nomes)
            ->setColors([
                '#55003E',
                '#d48c98',
                '#55003E',
                '#6d3f36',
                '#f3d8d9',
                '#813C52',
                '#986477',
            ]);
    }
}