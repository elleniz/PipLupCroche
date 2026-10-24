@extends('main')

@section('titulo', 'Formulário de categorias')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            FORMULÁRIO CATEGORIAS
        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">
            Cadastre uma nova categoria
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



        @if ($errors->any())

            <div class="alert alert-danger"
                 style="font-size: 13px;">

                <ul style="margin-bottom: 0;">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

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



        <div class="mb-3">

            <label for="descricao"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Descrição
            </label>

            <input type="text"
                   name="descricao"
                   id="descricao"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('descricao', $data->descricao ?? '') }}">

        </div>



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
                    style="border: 1px solid #d8b7b7;">

                <option value="">Selecione o tipo</option>

                <option value="brinco"
                    {{ old('tipo', $data->tipo ?? '') == 'brinco' ? 'selected' : '' }}>
                    Brinco
                </option>

                <option value="decoracao-quarto"
                    {{ old('tipo', $data->tipo ?? '') == 'decoracao-quarto' ? 'selected' : '' }}>
                    Decoração de Quarto
                </option>

                <option value="tiara"
                    {{ old('tipo', $data->tipo ?? '') == 'tiara' ? 'selected' : '' }}>
                    Acessório - tiara
                </option>

                <option value="Cropped"
                    {{ old('tipo', $data->tipo ?? '') == 'Cropped' ? 'selected' : '' }}>
                    Roupa - cropped
                </option>

                <option value="Bonecos"
                    {{ old('tipo', $data->tipo ?? '') == 'Bonecos' ? 'selected' : '' }}>
                    Bonecos
                </option>

                <option value="acessorio pequeno"
                    {{ old('tipo', $data->tipo ?? '') == 'acessorio pequeno' ? 'selected' : '' }}>
                    Acessório pequeno
                </option>


                <option value="utilitário"
                    {{ old('tipo', $data->tipo ?? '') == 'utilitário' ? 'selected' : '' }}>
                    Utilitário
                </option>

                <option value="outros"
                    {{ old('tipo', $data->tipo ?? '') == 'outros' ? 'selected' : '' }}>
                    Outros
                </option>


            </select>

            @error('tipo')
                <div class="text-danger mt-1" style="font-size: 13px;">
                    {{ $message }}
                </div>
            @enderror

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

            <a href="{{ route('categoria.list') }}"
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
        </div>

    </form>

</div>

@endsection
