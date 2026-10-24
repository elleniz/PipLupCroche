<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemVendaController extends Controller
{


public function index()
{
    $dados = ItemVenda::with(['venda', 'produto'])->get();

    return view('item_venda.list', compact('dados'));
}


   public function create()
{
    $data = new \App\Models\ItemVenda();

    $vendas = \App\Models\Venda::all();
    $produtos = \App\Models\Produto::all();

    return view('item_venda.form', compact(
        'data',
        'vendas',
        'produtos'
    ));
}
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'venda_id' => ['required', 'integer', 'exists:vendas,id'],
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        ItemVenda::create($dados);

        return redirect()
            ->route('item_venda.list')
            ->with('success', 'Item do venda cadastrado com sucesso!');
    }

    public function show(ItemVenda $itemVenda): View
    {
        $itemVenda->load(['venda', 'produto']);

        return view('item_vendas.show', compact('itemVenda'));
    }

    public function edit($id)
{
    $data = \App\Models\ItemVenda::findOrFail($id);

    $vendas = \App\Models\Venda::all();
    $produtos = \App\Models\Produto::all();

    return view('item_venda.form', compact(
        'data',
        'vendas',
        'produtos'
    ));
}

    public function update(
        Request $request,
        ItemVenda $itemVenda
    ): RedirectResponse {
        $dados = $request->validate([
            'venda_id' => ['required', 'integer', 'exists:vendas,id'],
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $itemVenda->update($dados);

        return redirect()
            ->route('item_venda.list')
            ->with('success', 'Item do venda atualizado com sucesso!');
    }

 public function destroy($id)
{
    $itemVenda = ItemVenda::findOrFail($id);

    $itemVenda->delete();

    return redirect('item_venda')
        ->with('success', 'Item da venda removido com sucesso!');
}

public function search(Request $request)
{
    if (!empty($request->valor)) {
        if ($request->tipo == 'produto_id') {
            $dados = ItemVenda::with(['venda', 'produto'])
                ->whereHas('produto', function ($query) use ($request) {
                    $query->where('nome', 'like', '%' . $request->valor . '%');
                })
                ->get();
        } else {
            $camposPermitidos = [
                'venda_id',
                'quantidade',
            ];

            if (in_array($request->tipo, $camposPermitidos)) {
                $dados = ItemVenda::with(['venda', 'produto'])
                    ->where(
                        $request->tipo,
                        'like',
                        '%' . $request->valor . '%'
                    )
                    ->get();
            } else {
                $dados = ItemVenda::with(['venda', 'produto'])->get();
            }
        }
    } else {
        $dados = ItemVenda::with(['venda', 'produto'])->get();
    }

    return view('item_venda.list', compact('dados'));
}


}