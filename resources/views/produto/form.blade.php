@extends('main')

@section('titulo', 'Formulário de Produtos')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

@php
    if (!empty($data->id)) {
        $action = route('produto.update', $data->id);
    } else {
        $action = route('produto.store');
    }
@endphp

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        CADASTRAR PRODUTO
    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Cadastre um novo produto
    </p>

</div>

<form action="{{ $action }}"
      method="post"
      class="p-4"
    enctype="multipart/form-data"
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

    {{-- PREÇO --}}
    <div class="mb-3">

        <label for="preco"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Preço
        </label>

        <input type="number"
               name="preco"
               id="preco"
               step="0.01"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('preco', $data->preco ?? '') }}">

    </div>

    {{-- QUANTIDADE --}}
    <div class="mb-3">

        <label for="quantidade"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Quantidade
        </label>

        <input type="number"
               name="quantidade"
               id="quantidade"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('quantidade', $data->quantidade ?? '') }}">

    </div>

    {{-- CATEGORIA --}}
    <div class="mb-3">

        <label for="categoria_id"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Categoria
        </label>

        <select name="categoria_id"
                id="categoria_id"
                class="form-select"
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">

            <option value="">Selecione uma categoria</option>

            @foreach($categorias as $categoria)

                <option value="{{ $categoria->id }}"
                    {{ old('categoria_id', $data->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>

                    {{ $categoria->nome }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- DESCRIÇÃO --}}
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

    {{-- MATERIAL --}}
    <div class="mb-3">

        <label for="material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Material
        </label>

        <select name="material"
                id="material"
                class="form-select"
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">
<p>Material salvo: {{ $data->material ?? 'NÃO ENCONTRADO' }}</p>
            <option value="">Selecione o material</option>


            <option value="ALGODAO"
                {{ old('material', $data->material ?? '') == 'ALGODAO' ? 'selected' : '' }}>
                ALGODÃO
            </option>

            <option value="ALGODAO-RECICLADO"
                {{ old('material', $data->material ?? '') == 'ALGODAO-RECICLADO' ? 'selected' : '' }}>
                ALGODÃO RECICLADO
            </option>

            <option value="BARBANTE"
                {{ old('material', $data->material ?? '') == 'BARBANTE' ? 'selected' : '' }}>
                BARBANTE
            </option>

            <option value="FIO-DE-MALHA"
                {{ old('material', $data->material ?? '') == 'FIO-DE-MALHA' ? 'selected' : '' }}>
                FIO DE MALHA
            </option>

            <option value="LA-NATURAL"
                {{ old('material', $data->material ?? '') == 'LA-NATURAL' ? 'selected' : '' }}>
                LÃ NATURAL
            </option>

            <option value="VISCOSE"
                {{ old('material', $data->material ?? '') == 'VISCOSE' ? 'selected' : '' }}>
                VISCOSE
            </option>

        </select>

    </div>

    {{-- PESO --}}
    <div class="mb-3">

        <label for="peso"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Peso
        </label>

        <input type="text"
               name="peso"
               id="peso"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('peso', $data->peso ?? '') }}">

    </div>

    <label for="imagem">Imagem</label>
                @php
                    $nome_imagem = !empty($data->imagem) ? $data->imagem : 'sem_imagem.jpg';
                @endphp
                <img src="/storage/{{ $nome_imagem }}" class="rounded-circle" width="200px" height="200px"
                    alt="Imagem" />
                <input type="file" name="imagem" class="form-control" value="{{ old('imagem', $data->imagem ?? '') }}">
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

        <a href="{{ url('produto') }}"
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
