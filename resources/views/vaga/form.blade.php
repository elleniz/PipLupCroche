@extends('main')

@section('titulo', 'Formulário de Vagas')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php

        if (!empty($data->id)) {
            $action = route('vaga.update', $data->id);
        } else {
            $action = route('vaga.store');
        }

    @endphp


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">

            {{ !empty($data->id) ? 'EDITAR VAGA' : 'CADASTRAR VAGA' }}

        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">

            {{ !empty($data->id)
                ? 'Edite os dados da vaga de trabalho'
                : 'Cadastre uma nova vaga de trabalho'
            }}

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



        <div class="mb-3">

            <label for="usuario_id"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Funcionário
            </label>

            <select name="usuario_id"
                    id="usuario_id"
                    class="form-select"
                    style="border: 1px solid #ccc;
                           border-radius: 5px;
                           font-size: 13px;
                           height: 40px;
                           padding: 7px 12px;">

                <option value="">
                    Vaga em aberto
                </option>

                @foreach ($funcionarios as $funcionario)

                    <option value="{{ $funcionario->id }}"
                        {{ old('usuario_id', $data->usuario_id ?? '') == $funcionario->id ? 'selected' : '' }}>

                        {{ $funcionario->nome }}

                    </option>

                @endforeach

            </select>

            @error('usuario_id')

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="mb-3">

            <label for="funcao"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Função / Cargo
            </label>

            <input type="text"
                   name="funcao"
                   id="funcao"
                   class="form-control"
                   placeholder="Ex: Artesã, Vendedora..."
                   value="{{ old('funcao', $data->funcao ?? '') }}"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            @error('funcao')

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    {{ $message }}

                </div>

            @enderror

        </div>


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
                   placeholder="Ex: 8.000,00"
                   class="form-control"
                   value="{{ old('salario', !empty($data->salario) ? number_format($data->salario, 2, ',', '.') : '') }}"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            @error('salario')

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    {{ $message }}

                </div>

            @enderror

        </div>


  <!-- ESCALA -->
<div class="mb-3">
    <label class="form-label">Escala</label>

    <select name="escala" class="form-select" required>
        <option value="">Selecione a escala</option>

        <option value="5x2"
            {{ old('escala', $data->escala ?? '') == '5x2' ? 'selected' : '' }}>
            5x2
        </option>

        <option value="6x1"
            {{ old('escala', $data->escala ?? '') == '6x1' ? 'selected' : '' }}>
            6x1
        </option>

        <option value="12x36"
            {{ old('escala', $data->escala ?? '') == '12x36' ? 'selected' : '' }}>
            12x36
        </option>

        <option value="4x3"
            {{ old('escala', $data->escala ?? '') == '4x3' ? 'selected' : '' }}>
            4x3
        </option>
    </select>
</div>


<!-- JORNADA -->
<div class="mb-3">
    <label class="form-label">Jornada de Trabalho</label>

    <select name="jornada_trabalho" class="form-select" required>
        <option value="">Selecione a jornada</option>

        <option value="4 horas por dia"
            {{ old('jornada_trabalho', $data->jornada_trabalho ?? '') == '4 horas por dia' ? 'selected' : '' }}>
            4 horas por dia
        </option>

        <option value="6 horas por dia"
            {{ old('jornada_trabalho', $data->jornada_trabalho ?? '') == '6 horas por dia' ? 'selected' : '' }}>
            6 horas por dia
        </option>

        <option value="8 horas por dia"
            {{ old('jornada_trabalho', $data->jornada_trabalho ?? '') == '8 horas por dia' ? 'selected' : '' }}>
            8 horas por dia
        </option>

        <option value="44 horas semanais"
            {{ old('jornada_trabalho', $data->jornada_trabalho ?? '') == '44 horas semanais' ? 'selected' : '' }}>
            44 horas semanais
        </option>
    </select>
</div>


<!-- TURNO -->
<div class="mb-3">
    <label class="form-label">Turno</label>

    <select name="turno" class="form-select" required>
        <option value="">Selecione o turno</option>

        <option value="Manhã"
            {{ old('turno', $data->turno ?? '') == 'Manhã' ? 'selected' : '' }}>
            Manhã
        </option>

        <option value="Tarde"
            {{ old('turno', $data->turno ?? '') == 'Tarde' ? 'selected' : '' }}>
            Tarde
        </option>

        <option value="Noite"
            {{ old('turno', $data->turno ?? '') == 'Noite' ? 'selected' : '' }}>
            Noite
        </option>

        <option value="Integral"
            {{ old('turno', $data->turno ?? '') == 'Integral' ? 'selected' : '' }}>
            Integral
        </option>
    </select>
</div>



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
                   placeholder="Ex: 5 anos"
                   value="{{ old('tempo_profissao', $data->tempo_profissao ?? '') }}"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            @error('tempo_profissao')

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    {{ $message }}

                </div>

            @enderror

        </div>

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


            <a href="{{ route('vaga.list') }}"
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

@stop
