<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Vaga;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function list()
    {
        $dados = Vaga::with('usuario')->get();

        return view('vaga.list', compact('dados'));
    }

    public function form($id = null)
    {
        if ($id) {

            $data = Vaga::with('usuario')->findOrFail($id);

            $funcionarios = Usuario::where('tipo', 'FUNCIONARIO')
                ->where(function ($query) use ($data) {

                    $query->whereDoesntHave('vaga')
                          ->orWhere('id', $data->usuario_id);

                })
                ->orderBy('nome')
                ->get();

        } else {

            $data = new Vaga();

            $funcionarios = Usuario::where('tipo', 'FUNCIONARIO')
                ->whereDoesntHave('vaga')
                ->orderBy('nome')
                ->get();

        }

        return view('vaga.form', compact('data', 'funcionarios'));
    }


    public function store(Request $request)
    {
        $dados = $this->validarDados($request);

        if (!empty($dados['usuario_id'])) {

            $funcionario = Usuario::findOrFail($dados['usuario_id']);

            if ($funcionario->tipo !== 'FUNCIONARIO') {

                return back()
                    ->withErrors([
                        'usuario_id' => 'Somente funcionários podem ser adicionados a uma vaga.'
                    ])
                    ->withInput();

            }

            if ($funcionario->vaga) {

                return back()
                    ->withErrors([
                        'usuario_id' => 'Este funcionário já está vinculado a uma vaga.'
                    ])
                    ->withInput();

            }
        }

        Vaga::create($dados);

        return redirect()
            ->route('vaga.list')
            ->with('success', 'Vaga cadastrada com sucesso!');
    }


    public function update(Request $request, $id)
    {
        $vaga = Vaga::findOrFail($id);

        $dados = $this->validarDados($request);

        if (!empty($dados['usuario_id'])) {

            $funcionario = Usuario::findOrFail($dados['usuario_id']);

            if ($funcionario->tipo !== 'FUNCIONARIO') {

                return back()
                    ->withErrors([
                        'usuario_id' => 'Somente funcionários podem ser adicionados a uma vaga.'
                    ])
                    ->withInput();

            }

            $outraVaga = Vaga::where('usuario_id', $funcionario->id)
                ->where('id', '!=', $vaga->id)
                ->first();

            if ($outraVaga) {

                return back()
                    ->withErrors([
                        'usuario_id' => 'Este funcionário já está vinculado a outra vaga.'
                    ])
                    ->withInput();

            }
        }

        $vaga->update($dados);

        return redirect()
            ->route('vaga.list')
            ->with('success', 'Vaga atualizada com sucesso!');
    }


    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);

        if ($vaga->usuario_id !== null) {

            return redirect()
                ->route('vaga.list')
                ->with('error', 'Não é possível excluir uma vaga que possui funcionário.');

        }

        $vaga->delete();

        return redirect()
            ->route('vaga.list')
            ->with('success', 'Vaga excluída com sucesso!');
    }


    public function search(Request $request)
    {
        $tipo = $request->tipo;
        $valor = $request->valor;

        $query = Vaga::with('usuario');

        if ($tipo === 'funcao') {

            $query->where('funcao', 'like', '%' . $valor . '%');

        } elseif ($tipo === 'escala') {

            $query->where('escala', 'like', '%' . $valor . '%');

        } elseif ($tipo === 'turno') {

            $query->where('turno', 'like', '%' . $valor . '%');

        } elseif ($tipo === 'usuario') {

            $query->whereHas('usuario', function ($q) use ($valor) {

                $q->where('nome', 'like', '%' . $valor . '%');

            });

        }

        $dados = $query->get();

        return view('vaga.list', compact('dados'));
    }


    private function validarDados(Request $request)
    {
        $request->validate([

            'usuario_id' => [
                'nullable',
                'integer',
                'exists:usuarios,id'
            ],

            'funcao' => [
                'required',
                'string',
                'max:255'
            ],

            'salario' => [
                'required',
                'string'
            ],

            'escala' => [
                'required',
                'string'
            ],

            'jornada_trabalho' => [
                'required',
                'string'
            ],

            'turno' => [
                'required',
                'string'
            ],

            'tempo_profissao' => [
                'required',
                'string',
                'max:255'
            ],

        ], [

            'funcao.required' => 'A função é obrigatória.',
            'salario.required' => 'O salário é obrigatório.',
            'escala.required' => 'A escala é obrigatória.',
            'jornada_trabalho.required' => 'A jornada de trabalho é obrigatória.',
            'turno.required' => 'O turno é obrigatório.',
            'tempo_profissao.required' => 'O tempo de profissão é obrigatório.',
            'usuario_id.exists' => 'O funcionário selecionado não existe.',

        ]);

        $salario = trim($request->salario);

        /*
        |--------------------------------------------------------------
        | Tratamento do salário
        |--------------------------------------------------------------
        |
        | Aceita:
        |
        | 8000
        | 8.000
        | 8,000
        | 8000,00
        | 8.000,00
        | 8000.00
        | 8,000.00
        |
        */

        if (str_contains($salario, ',') && str_contains($salario, '.')) {

            /*
            Exemplo:
            8.000,00
            */

            $salario = str_replace('.', '', $salario);
            $salario = str_replace(',', '.', $salario);

        } elseif (str_contains($salario, ',')) {

            /*
            Exemplo:
            8000,00
            8,000
            */

            $partes = explode(',', $salario);

            if (count($partes) === 2 && strlen($partes[1]) === 3) {

                $salario = str_replace(',', '', $salario);

            } else {

                $salario = str_replace(',', '.', $salario);

            }

        } elseif (str_contains($salario, '.')) {

            /*
            Exemplo:
            8.000
            8000.00
            */

            $partes = explode('.', $salario);

            if (count($partes) === 2 && strlen($partes[1]) === 3) {

                $salario = str_replace('.', '', $salario);

            }

        }

        if (!is_numeric($salario)) {

            return back()
                ->withErrors([
                    'salario' => 'Digite um salário válido.'
                ])
                ->withInput()
                ->throwResponse();

        }

        return [

            'usuario_id' => $request->usuario_id ?: null,

            'funcao' => $request->funcao,

            'salario' => number_format(
                (float) $salario,
                2,
                '.',
                ''
            ),

            'escala' => $request->escala,

            'jornada_trabalho' => $request->jornada_trabalho,

            'turno' => $request->turno,

            'tempo_profissao' => $request->tempo_profissao,

        ];
    }
}
