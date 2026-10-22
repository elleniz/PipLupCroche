<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $dados = Usuario::with('vaga')->get();

        return view('usuario.list', compact('dados'));
    }


    public function form(Request $request, $id = null)
    {
        $data = $id
            ? Usuario::with('vaga')->findOrFail($id)
            : null;

        $vagas = Vaga::whereNull('usuario_id')
            ->orWhere('usuario_id', $id)
            ->orderBy('funcao')
            ->get();

        $vagaSelecionada = null;

        if ($request->vaga_id) {
            $vagaSelecionada = Vaga::find($request->vaga_id);
        }

        return view('usuario.form', compact(
            'data',
            'vagas',
            'vagaSelecionada'
        ));

        /*
         * Mostra somente vagas que estão abertas.
         *
         * Se o usuário estiver editando um funcionário que já
         * possui uma vaga, a vaga dele também aparece.
         */

        $vagas = Vaga::whereNull('usuario_id')
            ->orWhere('usuario_id', $id)
            ->orderBy('funcao')
            ->get();

        return view('usuario.form', compact('data', 'vagas'));
    }


    public function store(Request $request)
    {
        $this->validateForm($request);
        $nome_imagem = null;

        $imagem = $request->file('imagem');
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/usuario/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');

            
        }


        $usuario = Usuario::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'data_nascimento' => $request->data_nascimento,
            'tipo' => $request->tipo,
            'imagem' => $nome_imagem, //nn tem isso no produto imagem
        ]);


        /*
         * FUNCIONÁRIO
         */
        if ($request->tipo === 'FUNCIONARIO') {

            /*
             * Se escolheu uma vaga que já existe,
             * apenas coloca o funcionário nela.
             */
            if ($request->tipo_vaga === 'existente') {

                $vaga = Vaga::findOrFail($request->vaga_id);

                /*
                 * Segurança: a vaga precisa estar aberta.
                 */
                if ($vaga->usuario_id !== null) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'vaga_id' => 'Esta vaga já está ocupada por outro funcionário.'
                        ]);
                }

                $vaga->update([
                    'usuario_id' => $usuario->id,
                ]);

            } else {

                /*
                 * Criar uma nova vaga.
                 */
                Vaga::create([
                    'usuario_id' => $usuario->id,
                    'funcao' => $request->funcao,
                    'salario' => $this->normalizarSalario($request->salario),
                    'escala' => $request->escala,
                    'jornada_trabalho' => $request->jornada_trabalho,
                    'turno' => $request->turno,
                    'tempo_profissao' => $request->tempo_profissao,
                ]);
            }
        }


        return redirect()
            ->route('usuario.list')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }


    public function update(Request $request, $id)
    {
        $usuario = Usuario::with('vaga')->findOrFail($id);

        $this->validateForm($request, $id);


        $usuario->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'data_nascimento' => $request->data_nascimento,
            'tipo' => $request->tipo,
            'imagem' => $request->imagem ?? null,
        ]);


        /*
         * FUNCIONÁRIO
         */
        if ($request->tipo === 'FUNCIONARIO') {

            /*
             * SELECIONOU UMA VAGA EXISTENTE
             */
            if ($request->tipo_vaga === 'existente') {

                $novaVaga = Vaga::findOrFail($request->vaga_id);

                /*
                 * Não permite pegar uma vaga que já pertence
                 * a outro funcionário.
                 */
                if (
                    $novaVaga->usuario_id !== null &&
                    $novaVaga->usuario_id != $usuario->id
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'vaga_id' => 'Esta vaga já está ocupada por outro funcionário.'
                        ]);
                }


                /*
                 * Se ele tinha outra vaga, ela fica aberta.
                 */
                if (
                    $usuario->vaga &&
                    $usuario->vaga->id != $novaVaga->id
                ) {
                    $usuario->vaga->update([
                        'usuario_id' => null,
                    ]);
                }


                /*
                 * Vincula a nova vaga ao funcionário.
                 */
                $novaVaga->update([
                    'usuario_id' => $usuario->id,
                ]);
            }


            /*
             * CRIAR UMA NOVA VAGA
             */
            else {

                /*
                 * Se já tinha uma vaga, ela fica aberta.
                 */
                if ($usuario->vaga) {

                    $usuario->vaga->update([
                        'usuario_id' => null,
                    ]);
                }


                /*
                 * Cria a nova vaga.
                 */
                Vaga::create([
                    'usuario_id' => $usuario->id,
                    'funcao' => $request->funcao,
                    'salario' => $this->normalizarSalario($request->salario),
                    'escala' => $request->escala,
                    'jornada_trabalho' => $request->jornada_trabalho,
                    'turno' => $request->turno,
                    'tempo_profissao' => $request->tempo_profissao,
                ]);
            }
        }


        /*
         * CLIENTE
         */
        if ($request->tipo === 'CLIENTE') {

            /*
             * A vaga NÃO é excluída.
             *
             * Ela simplesmente fica aberta.
             */
            if ($usuario->vaga) {

                $usuario->vaga->update([
                    'usuario_id' => null,
                ]);
            }
        }


        return redirect()
            ->route('usuario.list')
            ->with('success', 'Usuário atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        /*
         * A migration de vagas usa nullOnDelete().
         *
         * Portanto, ao excluir o funcionário,
         * a vaga continua existindo e fica aberta.
         */
        $usuario->delete();

        return redirect()
            ->route('usuario.list')
            ->with('success', 'Usuário excluído com sucesso!');
    }


    public function search(Request $request)
    {
        if (!empty($request->valor)) {

            $dados = Usuario::with('vaga')
                ->where(
                    $request->tipo,
                    'like',
                    "%$request->valor%"
                )
                ->get();

        } else {

            $dados = Usuario::with('vaga')->get();
        }

        return view('usuario.list', compact('dados'));
    }


    private function validateForm(Request $request, $id = null)
    {
        $regras = [

            'nome' => [
                'required',
                'string',
                'max:200'
            ],

            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('usuarios', 'cpf')->ignore($id),
            ],

            'telefone' => [
                'required',
                'string',
                'max:20'
            ],

            'email' => [
                'required',
                'email',
                'max:100'
            ],

            'endereco' => [
                'nullable',
                'string',
                'max:500'
            ],

            'data_nascimento' => [
                'nullable',
                'date',
                'before:today',
            ],

            'tipo' => [
                'required',
                Rule::in([
                    'CLIENTE',
                    'FUNCIONARIO',
                ]),
            ],
        ];


        /*
         * Campos da vaga.
         *
         * Só são obrigatórios quando o funcionário
         * escolhe CRIAR uma nova vaga.
         */
        if (
            $request->tipo === 'FUNCIONARIO' &&
            $request->tipo_vaga === 'nova'
        ) {

            $regras['funcao'] = [
                'required',
                'string',
                'max:255',
            ];

            $regras['salario'] = [
                'required',
                'string',
            ];

            $regras['escala'] = [
                'required',
                'string',
                'max:255',
            ];

            $regras['jornada_trabalho'] = [
                'required',
                'string',
                'max:255',
            ];

            $regras['turno'] = [
                'required',
                'string',
                'max:255',
            ];

            /*
             * NÃO é required.
             */
            $regras['tempo_profissao'] = [
                'nullable',
                'string',
                'max:255',
            ];
        }


        /*
         * Se escolheu vaga existente,
         * precisa selecionar uma vaga.
         */
        if (
            $request->tipo === 'FUNCIONARIO' &&
            $request->tipo_vaga === 'existente'
        ) {

            $regras['vaga_id'] = [
                'required',
                'exists:vagas,id',
            ];
        }


        $mensagens = [

            'nome.required' =>
                'O nome é obrigatório.',

            'cpf.required' =>
                'O CPF é obrigatório.',

            'cpf.unique' =>
                'Este CPF já está cadastrado.',

            'telefone.required' =>
                'O telefone é obrigatório.',

            'email.required' =>
                'O e-mail é obrigatório.',

            'email.email' =>
                'Digite um e-mail válido.',

            'data_nascimento.date' =>
                'A data de nascimento deve ser válida.',

            'data_nascimento.before' =>
                'A data de nascimento deve ser uma data no passado.',

            'tipo.required' =>
                'O tipo de usuário é obrigatório.',

            'funcao.required' =>
                'A função/cargo é obrigatória para funcionários.',

            'salario.required' =>
                'O salário é obrigatório para funcionários.',

            'escala.required' =>
                'A escala é obrigatória para funcionários.',

            'jornada_trabalho.required' =>
                'A jornada de trabalho é obrigatória para funcionários.',

            'turno.required' =>
                'O turno é obrigatório para funcionários.',

            'vaga_id.required' =>
                'Selecione uma vaga existente.',

            'imagem.image' => "O :attribute deve ser enviado",
            'imagem.mimes' => "O :attribute deve ser das extensões:PNG,JPEG,JPG",
        ];


        $request->validate($regras, $mensagens);


        /*
         * Validação manual do salário.
         */
        if (
            $request->tipo === 'FUNCIONARIO' &&
            $request->tipo_vaga === 'nova'
        ) {

            $salario = $this->normalizarSalario($request->salario);

            if ($salario === null) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'salario' => 'Digite um salário válido.'
                    ])
                    ->throwResponse();
            }
        }
    }


    private function normalizarSalario($valor)
    {
        if ($valor === null || trim($valor) === '') {
            return null;
        }

        $valor = trim($valor);

        /*
         * Exemplo:
         * 8.000,00 -> 8000.00
         */
        if (
            str_contains($valor, '.') &&
            str_contains($valor, ',')
        ) {

            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        }

        /*
         * Exemplo:
         * 8,000 -> 8000
         * 8000,00 -> 8000.00
         */
        elseif (str_contains($valor, ',')) {

            $partes = explode(',', $valor);

            if (isset($partes[1]) && strlen($partes[1]) === 3) {

                $valor = str_replace(',', '', $valor);

            } else {

                $valor = str_replace(',', '.', $valor);
            }
        }

        /*
         * Exemplo:
         * 8.000 -> 8000
         * 8000.00 -> 8000.00
         */
        elseif (str_contains($valor, '.')) {

            $partes = explode('.', $valor);

            if (isset($partes[1]) && strlen($partes[1]) === 3) {

                $valor = str_replace('.', '', $valor);
            }
        }


        if (!is_numeric($valor)) {
            return null;
        }

        return number_format(
            (float) $valor,
            2,
            '.',
            ''
        );
    }
}
