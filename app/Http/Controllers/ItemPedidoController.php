<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemPedidoController extends Controller
{
    public function index()
{
    $dados = \App\Models\ItemPedido::with('produto')->get();

    return view('item_pedido.list', compact('dados'));
}

   public function create()
{
    $data = new \App\Models\ItemPedido();

    $pedidos = \App\Models\Pedido::all();
    $produtos = \App\Models\Produto::all();

    return view('item_pedido.form', compact(
        'data',
        'pedidos',
        'produtos'
    ));
}
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        ItemPedido::create($dados);

        return redirect()
            ->route('item-pedidos.list')
            ->with('success', 'Item do pedido cadastrado com sucesso!');
    }

    public function show(ItemPedido $itemPedido): View
    {
        $itemPedido->load(['pedido', 'produto']);

        return view('item_pedidos.show', compact('itemPedido'));
    }

    public function edit($id)
{
    $data = \App\Models\ItemPedido::findOrFail($id);

    $pedidos = \App\Models\Pedido::all();
    $produtos = \App\Models\Produto::all();

    return view('item_pedido.form', compact(
        'data',
        'pedidos',
        'produtos'
    ));
}

    public function update(
        Request $request,
        ItemPedido $itemPedido
    ): RedirectResponse {
        $dados = $request->validate([
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $itemPedido->update($dados);

        return redirect()
            ->route('item-pedidos.list')
            ->with('success', 'Item do pedido atualizado com sucesso!');
    }

    public function destroy(ItemPedido $itemPedido): RedirectResponse
    {
        $itemPedido->delete();

        return redirect()
            ->route('item-pedidos.list')
            ->with('success', 'Item do pedido excluído com sucesso!');
    }
}
