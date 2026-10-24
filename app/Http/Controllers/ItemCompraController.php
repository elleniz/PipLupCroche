<?php

namespace App\Http\Controllers;

use App\Models\ItemCompra;
use App\Models\Compra;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemCompraController extends Controller
{

public function index()
{
    $dados = ItemCompra::with(['compra', 'material'])->get();

    return view('item_compra.list', compact('dados'));
}


   public function create()
{
    $data = new ItemCompra();
    
    $compras = Compra::all();
    $materiais = Material::all();

    return view('item_compra.form', compact(
        'data',
        'compras',
        'materiais'
    ));
}
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'compra_id' => ['required', 'integer', 'exists:compras,id'],
            'material_id' => ['required', 'integer', 'exists:materiais,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        ItemCompra::create($dados);

        return redirect()
            ->route('item_compra.list')
            ->with('success', 'Item da compra cadastrado com sucesso!');
    }

    public function show(ItemCompra $itemCompra): View
    {
        $itemCompra->load(['compra', 'material']);

        return view('item_compra.show', compact('itemCompra'));
    }

    public function edit($id)
{
    $data = ItemCompra::findOrFail($id);    

    $compras = Compra::all();
    $materiais = Material::all();

    return view('item_compra.form', compact(
        'data',
        'compras',
        'materiais'
    ));
}

    public function update(
        Request $request,
        ItemCompra $itemCompra
    ): RedirectResponse {
        $dados = $request->validate([
            'compra_id' => ['required', 'integer', 'exists:compras,id'],
            'material_id' => ['required', 'integer', 'exists:materiais,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $itemCompra->update($dados);

        return redirect()
            ->route('item_compra.list')
            ->with('success', 'Item da compra atualizado com sucesso!');
    }

 public function destroy($id)
{
    $itemCompra = ItemCompra::findOrFail($id);

    $itemCompra->delete();

    return redirect('item_compra')
        ->with('success', 'Item da compra removido com sucesso!');
}

public function search(Request $request)
{
    if (!empty($request->valor)) {
        if ($request->tipo == 'material_id') {
            $dados = ItemCompra::with(['compra', 'material'])
                ->whereHas('material', function ($query) use ($request) {
                    $query->where('nome_material', 'like', '%' . $request->valor . '%');
                })
                ->get();
        } else {
            $camposPermitidos = [
                'compra_id',
                'quantidade',
            ];

            if (in_array($request->tipo, $camposPermitidos)) {
                $dados = ItemCompra::with(['compra', 'material'])
                    ->where(
                        $request->tipo,
                        'like',
                        '%' . $request->valor . '%'
                    )
                    ->get();
            } else {
                $dados = ItemCompra::with(['compra', 'material'])->get();
            }
        }
    } else {
        $dados = ItemCompra::with(['compra', 'material'])->get();
    }

    return view('item_compra.list', compact('dados'));
}


}