@extends('main')

@section('titulo', 'Formulário de Materiais')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

@php
    $action = !empty($data->id)
        ? route('materiais.update', $data->id)
        : route('materiais.store');
@endphp

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        {{ !empty($data->id) ? 'EDITAR MATERIAL' : 'CADASTRAR MATERIAL' }}
    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Informe os dados do material para cadastrar no estoque.
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

    <div class="mb-3">

        <label for="nome_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Nome do material
        </label>

        <input type="text"
               name="nome_material"
               id="nome_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('nome_material', $data->nome_material ?? '') }}">

    </div>

    <div class="mb-3">

        <label for="marca_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Marca
        </label>

        <input type="text"
               name="marca_material"
               id="marca_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('marca_material', $data->marca_material ?? '') }}">

    </div>

    <div class="mb-3">

        <label for="tipo_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Tipo de material
        </label>

        <input type="text"
               name="tipo_material"
               id="tipo_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('tipo_material', $data->tipo_material ?? '') }}">

    </div>

    <div class="mb-3">

        <label for="valor_unitario"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Valor unitário (R$)
        </label>

        <input type="number"
               name="valor_unitario"
               id="valor_unitario"
               min="0"
               step="0.01"
               required
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('valor_unitario', $data->valor_unitario ?? '') }}">

    </div>

    <div class="mb-3">

        <label for="qtd_estoque"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Quantidade em estoque
        </label>

        <input type="number"
               name="qtd_estoque"
               id="qtd_estoque"
               min="0"
               step="1"
               required
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="{{ old('qtd_estoque', $data->qtd_estoque ?? 0) }}">

    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="font-size: 13px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between mt-3">

        <button type="submit"
                class="btn"
                style="background-color: #e88da5;
                       border: none;
                       border-radius: 20px;
                       color: white;
                       padding: 8px 30px;
                       font-size: 13px;">
            {{ !empty($data->id) ? 'Salvar alterações' : 'Salvar' }}
        </button>

        <a href="{{ route('materiais.index') }}"
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
