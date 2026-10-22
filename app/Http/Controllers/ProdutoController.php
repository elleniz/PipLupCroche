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
        // form recebe as categorias que estão cadastradas
    }

    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'preco' => ['required', 'numeric', 'min:0'],
            'quantidade' => ['required', 'integer', 'min:0'],
            'categoria_id' => [
                'required',
                'exists:categorias,id',
                'unique:produtos,categoria_id,' . $request->id
            ],
            'peso' => ['required', 'string', 'max:20'],
            'material' => ['required', 'string', 'max:40'],
            'imagem' => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:png,jpg,jpeg'
            ],

        ], [
            'nome.required' => 'O :attribute é obrigatório',
            'preco.required' => 'O :attribute é obrigatório',
            'quantidade.required' => 'O :attribute é obrigatório',
            'categoria_id.required' => 'A :attribute é obrigatória',
            'categoria_id.unique' => 'Essa categoria já está vinculada a outro produto!',
            'peso.required' => 'O :attribute é obrigatório!',
            'material.required' => 'O :attribute é obrigatório!',
            'imagem.required' => 'A imagem deve ser enviada!',
            'imagem.image' => 'O arquivo enviado deve ser uma imagem!',
            'imagem.mimes' => 'A imagem deve ter uma das extensões: PNG, JPEG ou JPG',

        ]);
    }

    function store(Request $request)
    {
        $this->validateForm($request);

        $nome_imagem = null;
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();
            $diretorio = 'imagem/produto/';
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
        }

        Produto::create([
            'nome' => $request->nome,
            'preco' => str_replace(',', '.', $request->preco),
            'quantidade' => $request->quantidade,
            'categoria_id' => $request->categoria_id,
            'descricao' => $request->descricao,
            'peso' => $request->peso,
            'material' => $request->material,
            'imagem' => $nome_imagem,
        ]);

        return redirect('produto')->with('success', 'Registro salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Produto::findOrFail($id);

        $categorias = Categoria::whereDoesntHave('produto')
            ->orWhere('id', $data->categoria_id)
            ->get();

        return view('produto.form', compact('data', 'categorias'));
        // também traz as categorias
    }

    function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $this->validateForm($request);

        $produto = Produto::findOrFail($id);

        $dados = [
            'nome' => $request->nome,
            'preco' => str_replace(',', '.', $request->preco),
            'quantidade' => $request->quantidade,
            'categoria_id' => $request->categoria_id,
            'descricao' => $request->descricao,
            'peso' => $request->peso,
            'material' => $request->material,
        ];

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdHis') . '.' . $imagem->getClientOriginalExtension();

            $imagem->storeAs('imagem/produto/', $nome_imagem, 'public');

            $dados['imagem'] = $nome_imagem;
        }

        $produto->update($dados);

        return redirect('produto')
            ->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        Produto::destroy($id);

        return redirect('produto')->with('success', 'Registro removido com sucesso!');
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
                    '%' . $request->valor . '%'
                )->get();

            } else {

                $dados = Produto::with('categoria')->get();
            }
        }

        return view('produto.list', compact('dados'));
    }
}