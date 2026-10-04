@extends('main')

@section('titulo', 'Formulário de Usuários')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php

        if (!empty($data->id)) {
            $action = route('usuario.update', $data->id);
        } else {
            $action = route('usuario.store');
        }

    @endphp


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            CADASTRAR USUÁRIO
        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">
            Cadastre um novo usuário
        </p>

    </div>


    <form action="{{ $action }}"
          method="post"
          class="p-4"
          style="background-color: #fff;
                 border: 1px solid #ddd;
                 border-radius: 6px;
                 box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                 max-width: 650px;
                 width: 100%;
                 margin: 0 auto;">

        @csrf

        @if (!empty($data->id))
            @method('PUT')
        @endif


        <input type="hidden"
               name="id"
               value="{{ old('id', $data->id ?? '') }}">


        {{-- NOME --}}

        <div class="mb-3">

            <label for="nome"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Nome
            </label>

            <input type="text"
                   name="nome"
                   id="nome"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('nome', $data->nome ?? '') }}">

        </div>


        {{-- CPF --}}

        <div class="mb-3">

            <label for="cpf"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                CPF
            </label>

            <input type="text"
                   name="cpf"
                   id="cpf"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('cpf', $data->cpf ?? '') }}">

        </div>


        {{-- TELEFONE --}}

        <div class="mb-3">

            <label for="telefone"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Telefone
            </label>

            <input type="text"
                   name="telefone"
                   id="telefone"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('telefone', $data->telefone ?? '') }}">

        </div>


        {{-- E-MAIL --}}

        <div class="mb-3">

            <label for="email"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                E-mail
            </label>

            <input type="email"
                   name="email"
                   id="email"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('email', $data->email ?? '') }}">

        </div>


        {{-- ENDEREÇO --}}

        <div class="mb-3">

            <label for="endereco"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Endereço
            </label>

            <input type="text"
                   name="endereco"
                   id="endereco"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('endereco', $data->endereco ?? '') }}">

        </div>


        {{-- DATA DE NASCIMENTO --}}

        <div class="mb-3">

            <label for="data_nascimento"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Data de nascimento
            </label>

            <input type="date"
                   name="data_nascimento"
                   id="data_nascimento"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('data_nascimento', $data->data_nascimento ?? '') }}">

        </div>


        {{-- TIPO --}}

        <div class="mb-3">

            <label for="tipo"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Tipo
            </label>

            <select name="tipo"
                    id="tipo"
                    class="form-select"
                    style="border: 1px solid #ccc;
                           border-radius: 5px;
                           font-size: 13px;
                           height: 40px;
                           padding: 7px 12px;">

                <option value="">
                    Selecione o tipo
                </option>

                <option value="CLIENTE"
                        {{ old('tipo', $data->tipo ?? '') == 'CLIENTE' ? 'selected' : '' }}>
                    CLIENTE
                </option>

                <option value="FUNCIONARIO"
                        {{ old('tipo', $data->tipo ?? '') == 'FUNCIONARIO' ? 'selected' : '' }}>
                    FUNCIONÁRIO
                </option>

            </select>

        </div>


        {{-- DADOS DA VAGA --}}

        <div id="dadosVaga"
             style="display: none;
                    border-top: 1px solid #ddd;
                    margin-top: 20px;
                    padding-top: 20px;">

            <h5 style="color: #6d3f36;
                       font-family: Georgia, serif;
                       font-weight: bold;
                       font-size: 16px;
                       margin-bottom: 20px;">
                Dados da Vaga
            </h5>


            {{-- ESCOLHA DA VAGA --}}

            <div class="mb-3">

                <label for="tipo_vaga"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Vaga
                </label>

                <select id="tipo_vaga"
                        name="tipo_vaga"
                        class="form-select"
                        style="border: 1px solid #ccc;
                               border-radius: 5px;
                               font-size: 13px;
                               height: 40px;
                               padding: 7px 12px;">

                    <option value="nova"
                        {{ old('tipo_vaga', !empty($data->vaga) ? 'existente' : 'nova') == 'nova' ? 'selected' : '' }}>
                        Criar nova vaga
                    </option>

                    <option value="existente"
                        {{ old('tipo_vaga', !empty($data->vaga) ? 'existente' : 'nova') == 'existente' ? 'selected' : '' }}>
                        Selecionar vaga existente
                    </option>

                </select>

            </div>


            {{-- VAGA EXISTENTE --}}

            <div id="vagaExistente"
                 class="mb-3"
                 style="display: none;">

                <label for="vaga_id"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Selecione uma vaga
                </label>

                <select name="vaga_id"
                        id="vaga_id"
                        class="form-select"
                        style="border: 1px solid #ccc;
                               border-radius: 5px;
                               font-size: 13px;
                               height: 40px;
                               padding: 7px 12px;">

                    <option value="">
                        Selecione uma vaga
                    </option>

                    @foreach ($vagas as $vaga)

                        <option value="{{ $vaga->id }}"
                                data-funcao="{{ $vaga->funcao }}"
                                data-salario="{{ $vaga->salario }}"
                                data-escala="{{ $vaga->escala }}"
                                data-jornada="{{ $vaga->jornada_trabalho }}"
                                data-turno="{{ $vaga->turno }}"
                                data-tempo="{{ $vaga->tempo_profissao }}"
                                {{ old('vaga_id', $data->vaga->id ?? '') == $vaga->id ? 'selected' : '' }}>

                            {{ $vaga->funcao }} - R$ {{ number_format($vaga->salario, 2, ',', '.') }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- FUNÇÃO --}}

            <div class="mb-3">

                <label for="funcao"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Função
                </label>

                <input type="text"
                       name="funcao"
                       id="funcao"
                       class="form-control"
                       style="border: 1px solid #ccc;
                              border-radius: 5px;
                              font-size: 13px;
                              height: 40px;
                              padding: 7px 12px;"
                       value="{{ old('funcao', $data->vaga->funcao ?? '') }}">

            </div>


            {{-- SALÁRIO --}}

            <div class="mb-3">

                <label for="salario"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Salário
                </label>

                <input type="text"
                       name="salario"
                       id="salario"
                       class="form-control"
                       placeholder="Ex.: 8.000,00"
                       style="border: 1px solid #ccc;
                              border-radius: 5px;
                              font-size: 13px;
                              height: 40px;
                              padding: 7px 12px;"
                       value="{{ old('salario', $data->vaga->salario ?? '') }}">

            </div>


            {{-- ESCALA --}}

            <div class="mb-3">

                <label for="escala"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Escala
                </label>

                <select name="escala"
                        id="escala"
                        class="form-select"
                        style="border: 1px solid #ccc;
                               border-radius: 5px;
                               font-size: 13px;
                               height: 40px;
                               padding: 7px 12px;">

                    <option value="">Selecione a escala</option>

                    <option value="5x2"
                        {{ old('escala', $data->vaga->escala ?? '') == '5x2' ? 'selected' : '' }}>
                        5x2
                    </option>

                    <option value="6x1"
                        {{ old('escala', $data->vaga->escala ?? '') == '6x1' ? 'selected' : '' }}>
                        6x1
                    </option>

                    <option value="12x36"
                        {{ old('escala', $data->vaga->escala ?? '') == '12x36' ? 'selected' : '' }}>
                        12x36
                    </option>

                    <option value="4x3"
                        {{ old('escala', $data->vaga->escala ?? '') == '4x3' ? 'selected' : '' }}>
                        4x3
                    </option>

                </select>

            </div>


            {{-- JORNADA --}}

            <div class="mb-3">

                <label for="jornada_trabalho"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Jornada de trabalho
                </label>

                <select name="jornada_trabalho"
                        id="jornada_trabalho"
                        class="form-select"
                        style="border: 1px solid #ccc;
                               border-radius: 5px;
                               font-size: 13px;
                               height: 40px;
                               padding: 7px 12px;">

                    <option value="">Selecione a jornada</option>

                    <option value="4 horas por dia"
                        {{ old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '4 horas por dia' ? 'selected' : '' }}>
                        4 horas por dia
                    </option>

                    <option value="6 horas por dia"
                        {{ old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '6 horas por dia' ? 'selected' : '' }}>
                        6 horas por dia
                    </option>

                    <option value="8 horas por dia"
                        {{ old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '8 horas por dia' ? 'selected' : '' }}>
                        8 horas por dia
                    </option>

                    <option value="44 horas semanais"
                        {{ old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '44 horas semanais' ? 'selected' : '' }}>
                        44 horas semanais
                    </option>

                </select>

            </div>


            {{-- TURNO --}}

            <div class="mb-3">

                <label for="turno"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Turno
                </label>

                <select name="turno"
                        id="turno"
                        class="form-select"
                        style="border: 1px solid #ccc;
                               border-radius: 5px;
                               font-size: 13px;
                               height: 40px;
                               padding: 7px 12px;">

                    <option value="">Selecione o turno</option>

                    <option value="Manhã"
                        {{ old('turno', $data->vaga->turno ?? '') == 'Manhã' ? 'selected' : '' }}>
                        Manhã
                    </option>

                    <option value="Tarde"
                        {{ old('turno', $data->vaga->turno ?? '') == 'Tarde' ? 'selected' : '' }}>
                        Tarde
                    </option>

                    <option value="Noite"
                        {{ old('turno', $data->vaga->turno ?? '') == 'Noite' ? 'selected' : '' }}>
                        Noite
                    </option>

                    <option value="Integral"
                        {{ old('turno', $data->vaga->turno ?? '') == 'Integral' ? 'selected' : '' }}>
                        Integral
                    </option>

                </select>

            </div>


            {{-- TEMPO DE PROFISSÃO --}}

            <div class="mb-3">

                <label for="tempo_profissao"
                       class="form-label"
                       style="color: #555;
                              font-size: 13px;
                              font-weight: 500;">
                    Tempo de profissão
                </label>

                <input type="text"
                       name="tempo_profissao"
                       id="tempo_profissao"
                       class="form-control"
                       style="border: 1px solid #ccc;
                              border-radius: 5px;
                              font-size: 13px;
                              height: 40px;
                              padding: 7px 12px;"
                       value="{{ old('tempo_profissao', $data->vaga->tempo_profissao ?? '') }}">

            </div>

        </div>


        {{-- BOTÕES --}}

        <div class="d-flex justify-content-between mt-3">

            <button type="submit"
                    class="btn"
                    style="background-color: #e88da5;
                           border: none;
                           border-radius: 20px;
                           color: white;
                           padding: 8px 30px;
                           font-size: 13px;">
                Salvar
            </button>


            <a href="{{ route('usuario.list') }}"
               class="btn"
               style="background-color: #c90045;
                      border: none;
                      border-radius: 20px;
                      color: white;
                      padding: 8px 30px;
                      font-size: 13px;">
                Voltar
            </a>

        </div>

    </form>

</div>


<script>

    function mostrarDadosVaga() {

        let tipo = document.getElementById('tipo').value;
        let dadosVaga = document.getElementById('dadosVaga');

        if (tipo === 'FUNCIONARIO') {
            dadosVaga.style.display = 'block';
        } else {
            dadosVaga.style.display = 'none';
        }

    }


    function mostrarTipoVaga() {

        let tipoVaga = document.getElementById('tipo_vaga').value;

        let vagaExistente = document.getElementById('vagaExistente');

        let funcao = document.getElementById('funcao');
        let salario = document.getElementById('salario');
        let escala = document.getElementById('escala');
        let jornada = document.getElementById('jornada_trabalho');
        let turno = document.getElementById('turno');
        let tempo = document.getElementById('tempo_profissao');

        if (tipoVaga === 'existente') {

            vagaExistente.style.display = 'block';

            funcao.readOnly = true;
            salario.readOnly = true;
            escala.disabled = true;
            jornada.disabled = true;
            turno.disabled = true;
            tempo.readOnly = true;

        } else {

            vagaExistente.style.display = 'none';

            funcao.readOnly = false;
            salario.readOnly = false;
            escala.disabled = false;
            jornada.disabled = false;
            turno.disabled = false;
            tempo.readOnly = false;

            document.getElementById('vaga_id').value = '';

        }

    }


    function importarDadosVaga() {

        let select = document.getElementById('vaga_id');

        if (!select.value) {
            return;
        }

        let opcao = select.options[select.selectedIndex];

        document.getElementById('funcao').value =
            opcao.dataset.funcao;

        document.getElementById('salario').value =
            opcao.dataset.salario;

        document.getElementById('escala').value =
            opcao.dataset.escala;

        document.getElementById('jornada_trabalho').value =
            opcao.dataset.jornada;

        document.getElementById('turno').value =
            opcao.dataset.turno;

        document.getElementById('tempo_profissao').value =
            opcao.dataset.tempo;

    }


    document.getElementById('tipo')
        .addEventListener('change', mostrarDadosVaga);

    document.getElementById('tipo_vaga')
        .addEventListener('change', mostrarTipoVaga);

    document.getElementById('vaga_id')
        .addEventListener('change', importarDadosVaga);


    mostrarDadosVaga();
    mostrarTipoVaga();

    @if (old('vaga_id', $data->vaga->id ?? ''))
        importarDadosVaga();
    @endif

</script>

@stop
