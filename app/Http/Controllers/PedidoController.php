<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Usuario;

class PedidoController extends Controller
{
    public function index()
    {
        $dados = Pedido::with('usuario')->get();

        return view('pedido.list', compact('dados'));
    }

    public function create() //pega somente usuarios tipo cliente
    {
        $usuarios = Usuario::where('tipo', 'CLIENTE')->get();

        return view('pedido.form', compact('usuarios'));
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
            'valor_total' => [
                'required',
                'numeric',
                'min:0',
            ],
            'status' => [
                'required',            ],
        ], [

            'usuario_id.required' => 'Selecione um cliente.',
            'usuario_id.exists' => 'O cliente selecionado não está cadastrado.',
            'data.required' => 'A data do pedido é um campo obrigatório.',
            'data.date' => 'Informe uma data válida.',
            'valor_total.required' => 'O valor total é obrigatório.',
            'valor_total.numeric' => 'O valor deve ser válido.',
            'valor_total.min' => 'O valor não pode ser menor que 0.',
            'status.required' => 'Selecione o status do pedido.',
        ]);

        $usuario = Usuario::find($request->usuario_id);

        //verifica se o usuario é cliente
        if (!$usuario || $usuario->tipo !== 'CLIENTE') {
            throw ValidationException::withMessages([
                'usuario_id' => 'Somente usuários do tipo CLIENTE podem ter pedidos.',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Pedido::create($request->only([
            'usuario_id',
            'data',
            'prazo_entrega',
            'valor_total',
            'status',
        ]));

        return redirect('pedido')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $data = Pedido::findOrFail($id);

        //pega o tipo cliente aqui também
        $usuarios = Usuario::where('tipo', 'CLIENTE')
            ->orWhere('id', $data->usuario_id)
            ->get();

        return view('pedido.form', compact('data', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $pedido = Pedido::findOrFail($id);

        $pedido->update($request->only([
            'usuario_id',
            'data',
            'valor_total',
            'status',
        ]));

        return redirect('pedido')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Pedido::destroy($id);

        return redirect('pedido')
            ->with('success', 'Pedido removido com sucesso!');
    }


    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Pedido::with('usuario')
                ->where(
                    $request->tipo,
                    'like',
                    "%$request->valor%"
                )
                ->get();
        } else {
            $dados = Pedido::with('usuario')->get();
        }

        return view('pedido.list', compact('dados'));
    }

}
