@extends('main')

@section('titulo', 'Formulário de clientes')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

@php
    if (!empty($data->id)) {
        $action = route('cliente.update', $data->id);
    } else {
        $action = route('cliente.store');
    }
@endphp

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        FORMULÁRIO CLIENTE
    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Cadastre um novo cliente
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


    <div class="mb-3">

        <label for="email"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Email
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

        <a href="{{ url('cliente') }}"
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

@endsection
