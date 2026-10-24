<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Material;
use App\Models\Compra;
use App\Charts\ValorGastoComprasChart;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function index()
    {
        $dados = Compra::with('materiais')->get();

        return view('compra.list', compact('dados'));
    }

    public function create()
    {
        $materiais = Material::all();

        return view('compra.form', compact('materiais'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'fornecedor' => ['required'],
            'data_compra' => ['required', 'date'],

            'materiais' => ['required', 'array', 'min:1'],
            'materiais.*' => [
                'required',
                'distinct',
                'exists:materiais,id',
            ],

            'quantidades' => ['required', 'array', 'min:1'],
            'quantidades.*' => ['required', 'integer', 'min:1'],
        ], [
            'fornecedor.required' => 'O fornecedor é obrigatório.',
            'data_compra.required' => 'A data da compra é obrigatória.',
            'data_compra.date' => 'Informe uma data válida.',
            'materiais.required' => 'Selecione pelo menos um material.',
            'materiais.*.distinct' => 'Não selecione o mesmo material duas vezes.',
            'materiais.*.exists' => 'Um dos materiais selecionados não está cadastrado.',
            'quantidades.*.required' => 'Informe a quantidade de cada material.',
            'quantidades.*.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidades.*.min' => 'A quantidade deve ser pelo menos 1.',
        ]);

        if (count($request->materiais) != count($request->quantidades)) {
            throw ValidationException::withMessages([
                'quantidades' => 'Informe a quantidade de cada material.',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        DB::transaction(function () use ($request) { //db p nn dar ruim em 1 só, cancela tudo
            $compra = Compra::create([
                'fornecedor' => $request->fornecedor,
                'data_compra' => $request->data_compra,
                'valor_total' => 0,
            ]);

            $total = 0;
            $itens = [];

            foreach ($request->materiais as $indice => $materialId) {
                $material = Material::findOrFail($materialId);
                $quantidade = (int) $request->quantidades[$indice];

                $itens[$material->id] = [
                    'quantidade' => $quantidade,
                ];

                $total += $material->valor_unitario * $quantidade;
            }

            $compra->materiais()->attach($itens); //attach - salva no item compra 

            $compra->update([
                'valor_total' => $total,
            ]);
        });

        return redirect('compras')
            ->with('success', 'Compra cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $data = Compra::with('materiais')->findOrFail($id);
        $materiais = Material::all();

        return view('compra.form', compact('data', 'materiais'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        DB::transaction(function () use ($request, $id) {
            $compra = Compra::findOrFail($id);

            $compra->update([
                'fornecedor' => $request->fornecedor,
                'data_compra' => $request->data_compra,
            ]);

            $total = 0; //o valor começa com 0 ne
            $itens = [];

            foreach ($request->materiais as $indice => $materialId) {
                $material = Material::findOrFail($materialId);
                $quantidade = (int) $request->quantidades[$indice];

                $itens[$material->id] = [
                    'quantidade' => $quantidade,
                ];

                $total += $material->valor_unitario * $quantidade;
            }

            $compra->materiais()->sync($itens); //remove os q n tao relecionados, é de relacao

            $compra->update([
                'valor_total' => $total,
            ]);
        });

        return redirect('compras')
            ->with('success', 'Compra atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);

        $compra->materiais()->detach();//lembrar do detach para nao exluir oq ta relacionado

        $compra->delete();

        return redirect('compras')
            ->with('success', 'Compra removida com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $camposPermitidos = [
                'fornecedor',
                'valor_total',
                'data_compra',
            ];

            if (in_array($request->tipo, $camposPermitidos)) { //p ver se os campos sao iguais os d cima
                $dados = Compra::with('materiais')
                    ->where(
                        $request->tipo,
                        'like',
                        '%' . $request->valor . '%'
                    )
                    ->get();
            } else {
                $dados = Compra::with('materiais')->get();
            }
        } else {
            $dados = Compra::with('materiais')->get();
        }

        return view('compra.list', compact('dados'));
    }

    //FAZER VIEW DO RELATORIO!!!!!!!!!!!!!!!!!  
    public function report()
    {
        $compras = Compra::with('materiais')
            ->orderBy('data_compra')
            ->get();

        $data = [
            'titulo' => 'Relatório de Listagem de Compras',
            'date' => date('d/m/Y'),
            'dados' => $compras,
            'totalVendas' => $compras->count(),
            'valorArrecadado' => $compras->sum('valor_total'),
        ];

        $pdf = Pdf::loadView('compra.report', $data);

        return $pdf->download('relatorio_compras.pdf');
    }

    
    public function chartProdutosMaisVendidos(
        ProdutosMaisVendidosChart $chart
    ) {
        return view('compra.produtosMaisVendidosCHart', [
            'chart' => $chart->build(),
        ]);
    }

    public function ValorGastoComprasChart(
        ValorGastoComprasChart $chart
    ) {
        return view('compra.valorGastoComprasChart', [
            'chart' => $chart->build(),
        ]);
    }
}
