<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $dados = Material::all();

        return view('material.list', compact('dados'));
    }

    public function create()
    {
        return view('material.form');
    }

    private function validateForm(Request $request): array
    {
        return $request->validate([
            'nome_material' => 'required|string|max:255',
            'marca_material' => 'required|string|max:255',
            'tipo_material' => 'required|string|max:255',
            'valor_unitario' => 'required|numeric|min:0',
            'qtd_estoque' => 'required|integer|min:0',
        ], [
            'nome_material.required' => 'O nome do material é obrigatório.',
            'nome_material.string' => 'O nome do material deve ser um texto.',
            'nome_material.max' => 'O nome do material deve ter no máximo 255 caracteres.',

            'marca_material.required' => 'A marca do material é obrigatória.',
            'marca_material.string' => 'A marca deve ser um texto.',
            'marca_material.max' => 'A marca deve ter no máximo 255 caracteres.',

            'tipo_material.required' => 'O tipo do material é obrigatório.',
            'tipo_material.string' => 'O tipo deve ser um texto.',
            'tipo_material.max' => 'O tipo deve ter no máximo 255 caracteres.',

            'valor_unitario.required' => 'O valor unitário é obrigatório.',
            'valor_unitario.numeric' => 'O valor unitário deve ser numérico.',
            'valor_unitario.min' => 'O valor unitário não pode ser negativo.',

            'qtd_estoque.required' => 'A quantidade em estoque é obrigatória.',
            'qtd_estoque.integer' => 'A quantidade deve ser um número inteiro.',
            'qtd_estoque.min' => 'A quantidade não pode ser negativa.',
        ]);
    }

    public function store(Request $request)
    {
        $dados = $this->validateForm($request);

        Material::create($dados);

        return redirect('/materiais')
            ->with('success', 'Material cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $data = Material::findOrFail($id);

        return view('material.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $dados = $this->validateForm($request);

        $material = Material::findOrFail($id);
        $material->update($dados);

        return redirect('/materiais')
            ->with('success', 'Material atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return redirect('/materiais')
            ->with('success', 'Material excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $camposPermitidos = [
            'nome_material',
            'marca_material',
            'tipo_material',
            'valor_unitario',
            'qtd_estoque',
        ];

        $query = Material::query();

        $campo = $request->input('tipo');
        $valor = $request->input('valor');

        if (
            $request->filled('valor') &&
            in_array($campo, $camposPermitidos, true)
        ) {
            if (in_array($campo, [
                'valor_unitario',
                'qtd_estoque',
            ], true)) {
                $query->where($campo, $valor);
            } else {
                $query->where($campo, 'like', '%' . $valor . '%');
            }
        }

        $dados = $query->get();

        return view('material.list', compact('dados'));
    }
}