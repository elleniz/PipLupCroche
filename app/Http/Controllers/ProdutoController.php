<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = Produto::with('categoria')->get();

        return view('produto.list')->with([
            'dados' => $dados
        ]);
    }

    function create()
    {
        $categorias = Categoria::whereDoesntHave('produto')->get();
        
        return view('produto.form', compact('categorias'));
        //form recebe as categorias q tao cadastradas
    }


    function validateForm(Request $request)
    {
        $request->validate([
        'nome' => ['required', 'string', 'max:255'],
        'preco' => ['required'],
        'quantidade' => ['required', 'integer', 'min:0'],
        'categoria_id' => ['required', 'exists:categorias,id', 'unique:produtos,categoria_id'],
        'peso' => ['required', 'string', 'max:20'],
        'material' => ['required', 'string', 'max:40'],
        'imagem' => $nome_imagem,

        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'preco.required' => "O :attribute é obrigatorio",
            'quantidade.required' => "O :attribute é obrigatorio",
            'categoria_id.required' => "A :attribute é obrigatóriax ",
            'categoria_id.unique' => "Essa categoria já está vinculada a outro produto!",
            'peso' => "O :attribute é obrigatório!",
            'material' => "O :attribute é obrigatório!",
            'imagem.image' => "O :attribute deve ser enviado",
            'imagem.mimes' => "O :attribute deve ser das extensões:PNG,JPEG,JPG",

        ]);
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $nome_imagem = null;
        $imagem = $request->file('imagem');
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/produto/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');

        }

        Produto::create($request->all());
        

        return redirect('produto')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Produto::find($id);
        $categorias = Categoria::whereDoesntHave('produto')
        ->orWhere('id', $data->categoria_id)
        ->get();

        return view('produto.form', compact('data', 'categorias'));
        //tb ta trazendo as cateogiras
    }


    function update(Request $request, $id)
    {
        $this->validateForm($request);

        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'preco' => str_replace(',', '.', $request->preco),
            'quantidade' => $request->quantidade,
            'categoria_id' => $request->categoria_id,
            'descricao' => $request->descricao,
            'peso' => $request->peso,
            'material' => $request->material,
            'imagem' => $request->imagem ?? null,

        ]);

        return redirect('produto')
            ->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        Produto::destroy($id);

        return redirect('produto')->with("success", 'Registro removido com sucesso!');
    }

public function search(Request $request)
{
    if ($request->tipo === 'categoria') {

        $dados = Produto::whereHas('categoria', function ($query) use ($request) {
            $query->where(
                'nome',
                'like',
                '%' . $request->valor . '%'
            );
        })->get();

    } else {

        if (!empty($request->valor)) {

            $dados = Produto::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();

        } else {

            $dados = Produto::All();
        }
    }

    return view('produto.list', compact('dados'));
}
}
