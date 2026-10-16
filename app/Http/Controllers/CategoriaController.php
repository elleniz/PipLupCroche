<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function list()
    {
        $dados = Categoria::with('produto')->get();

        return view('categoria.list', compact('dados'));
    }


        public function form($id = null)
        {
            if ($id) {
                $data = Categoria::findOrFail($id);
                $action = route('categoria.update', $id);
            } else {
                $data = new Categoria();
                $action = route('categoria.store');
            }

            return view('categoria.form', compact('data', 'action'));
        }



    public function store(Request $request)
    {
        $dados = $this->validarDados($request);

        Categoria::create($dados);

        return redirect()
            ->route('categoria.list')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }


    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $dados = $this->validarDados($request);

        $categoria->update($dados);

        return redirect()
            ->route('categoria.list')
            ->with('success', 'Categoria atualizada com sucesso!');
    }


    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->produto) {
            return redirect()
                ->route('categoria.list')
                ->with('error', 'Não é possível excluir esta categoria porque existe um produto vinculado a ela!');
        }

        $categoria->delete();

        return redirect()
            ->route('categoria.list')
            ->with('success', 'Categoria excluída com sucesso!');
    }


    public function search(Request $request) {
        if (!empty($request->valor)) {
            if ($request->tipo === 'produto') {
                $dados = Categoria::whereHas('produto', function ($query) use ($request) {
                    $query->where( 'nome', 'like', "%$request->valor%" );
                    })->with('produto')->get();
                    } else {
                        $dados = Categoria::where( $request->tipo, 'like', "%$request->valor%" )->with('produto')->get(); }
                        } else { $dados = Categoria::with('produto')->get();
                        } return view('categoria.list', compact('dados')); }

    private function validarDados(Request $request)
    {
        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:100'
            ],

            'descricao' => [
                'nullable',
                'string',
                'max:255'
            ],

            'tipo' => [
                'required',
                'string',
                'max:50'
            ],

        ], [

            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.string' => 'O nome da categoria deve ser um texto.',
            'nome.max' => 'O nome da categoria pode ter no máximo 100 caracteres.',

            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição pode ter no máximo 255 caracteres.',

            'tipo.required' => 'O tipo da categoria é obrigatório.',
            'tipo.string' => 'O tipo deve ser um texto.',
            'tipo.max' => 'O tipo pode ter no máximo 50 caracteres.',
        ]);

        return $request->only([
            'nome',
            'descricao',
            'tipo'
        ]);
    }
}
