<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\ItemVenda;
use App\Models\Venda;
use App\Charts\ProdutosMaisVendidosChart;
use Barryvdh\DomPDF\Facade\Pdf;

class VendaController extends Controller
{
    public function index()
    {
        $dados = Venda::with('usuario', 'itensVenda')->get();

        return view('venda.list', compact('dados'));
    }

    public function create()
    {
        $usuarios = Usuario::where('tipo', 'CLIENTE')->get();

        $produtos = Produto::all();

        return view('venda.form', compact('usuarios', 'produtos'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'usuario_id' => [
                'required',
                'exists:usuarios,id',
            ],
            'data' => [
                'required',
                'date',
            ],
            'prazo_entrega' => [
                'nullable',
                'date',
            ],
            'status' => [
                'required',
                'in:PENDENTE,PAGO,EM_PRODUCAO,ENVIADO,ENTREGUE',
            ],
            'produtos' => [
                'required',
                'array',
                'min:1',
            ],
            'produtos.*' => [
                'required',
                'distinct',
                'exists:produtos,id',
            ],
            'quantidades' => [
                'required',
                'array',
                'min:1',
            ],
            'quantidades.*' => [
                'required',
                'integer',
                'min:1',
            ],
        ], [
            'usuario_id.required' => 'Selecione um cliente.',
            'usuario_id.exists' => 'O cliente selecionado não está cadastrado.',
            'data.required' => 'A data da venda é obrigatória.',
            'data.date' => 'Informe uma data válida.',
            'prazo_entrega.date' => 'Informe um prazo de entrega válido.',
            'status.required' => 'Selecione o status da venda.',
            'status.in' => 'Selecione um status válido.',
            'produtos.required' => 'Selecione pelo menos um produto.',
            'produtos.array' => 'Selecione os produtos corretamente.',
            'produtos.*.required' => 'Selecione um produto.',
            'produtos.*.distinct' => 'Não selecione o mesmo produto duas vezes.',
            'produtos.*.exists' => 'Um dos produtos selecionados não está cadastrado.',
            'quantidades.required' => 'Informe as quantidades dos produtos.',
            'quantidades.*.required' => 'Informe a quantidade de cada produto.',
            'quantidades.*.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidades.*.min' => 'A quantidade deve ser pelo menos 1.',
        ]);

        if (count($request->produtos) != count($request->quantidades)) {
            throw ValidationException::withMessages([
                'quantidades' => 'Informe a quantidade de cada produto.',
            ]);
        }

        $usuario = Usuario::find($request->usuario_id);

        if (!$usuario || $usuario->tipo !== 'CLIENTE') {
            throw ValidationException::withMessages([
                'usuario_id' => 'Somente usuários do tipo CLIENTE podem ter vendas.',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        DB::transaction(function () use ($request) {
            // Cria a venda
            $venda = Venda::create([
                'usuario_id' => $request->usuario_id,
                'data' => $request->data,
                'prazo_entrega' => $request->prazo_entrega,
                'valor_total' => 0,
                'status' => $request->status,
            ]);

            $total = 0;
            $itens = [];

            foreach ($request->produtos as $indice => $produtoId) {
                $produto = Produto::findOrFail($produtoId);
                $quantidade = (int) $request->quantidades[$indice];

                $itens[$produto->id] = [
                    'quantidade' => $quantidade,
                ];

                $total += $produto->preco * $quantidade;
            }

            $venda->produtos()->attach($itens);

            $venda->update([
                'valor_total' => $total,
            ]);
        });

        return redirect('vendas')
            ->with('success', 'Venda cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $data = Venda::with('produtos')->findOrFail($id);

        $usuarios = Usuario::where('tipo', 'CLIENTE')
            ->orWhere('id', $data->usuario_id)
            ->get();

        $produtos = Produto::all();

        return view('venda.form', compact('data', 'usuarios', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        DB::transaction(function () use ($request, $id) {
            $venda = Venda::findOrFail($id);

            $venda->update([
                'usuario_id' => $request->usuario_id,
                'data' => $request->data,
                'prazo_entrega' => $request->prazo_entrega,
                'status' => $request->status,
            ]);

            $total = 0;
            $itens = [];

            foreach ($request->produtos as $indice => $produtoId) {
                $produto = Produto::findOrFail($produtoId);
                $quantidade = (int) $request->quantidades[$indice];

                $itens[$produto->id] = [
                    'quantidade' => $quantidade,
                ];

                $total += $produto->preco * $quantidade;
            }

            $venda->produtos()->sync($itens);

            $venda->update([
                'valor_total' => $total,
            ]);
        });

        return redirect('vendas')
            ->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);

        $venda->produtos()->detach();

        $venda->delete();

        return redirect('vendas')
            ->with('success', 'Venda removida com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            if ($request->tipo == 'cliente') {
                $dados = Venda::with(['usuario', 'produtos'])
                    ->whereHas('usuario', function ($query) use ($request) {
                        $query->where(
                            'nome',
                            'like',
                            '%' . $request->valor . '%'
                        );
                    })
                    ->get();
            } else {
                $camposPermitidos = [
                    'data',
                    'prazo_entrega',
                    'status',
                    'valor_total',
                ];

                if (in_array($request->tipo, $camposPermitidos)) {
                    $dados = Venda::with(['usuario', 'produtos'])
                        ->where(
                            $request->tipo,
                            'like',
                            '%' . $request->valor . '%'
                        )
                        ->get();
                } else {
                    $dados = Venda::with(['usuario', 'produtos'])->get();
                }
            }
        } else {
            $dados = Venda::with(['usuario', 'produtos'])->get();
        }

        return view('venda.list', compact('dados'));
    }

    // RELATÓRIO
    public function report()
    {
        $venda = Venda::with('usuario')
            ->orderBy('data')
            ->get();

        $data = [
            'titulo' => 'Relatório de Listagem de Vendas',
            'date' => date('d/m/Y'),
            'dados' => $venda,
            'totalVendas' => $venda->count(),
            'valorArrecadado' => $venda->sum('valor_total'),
        ];

        $pdf = Pdf::loadView('venda.report', $data);

        return $pdf->download('relatorio_vendas.pdf');
    }

    // GRÁFICOS
    public function chartProdutosMaisVendidos(
        ProdutosMaisVendidosChart $chart
    ) {
        return view('venda.produtosMaisVendidosCHart', [
            'chart' => $chart->build(),
        ]);
    }
    
}
