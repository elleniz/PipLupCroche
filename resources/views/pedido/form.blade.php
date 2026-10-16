@extends('main')

@section('titulo', 'Formulário de Pedidos')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php
        if (!empty($data->id)) {
            $action = route('pedido.update', $data->id);
        } else {
            $action = route('pedido.store');
        }
    @endphp

    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            {{ !empty($data->id) ? 'ATUALIZAR PEDIDO' : 'CADASTRAR PEDIDO' }}
        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">
            Cadastre ou atualize um pedido
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

        {{-- Cliente --}}
        <div class="mb-3">

            <label for="usuario_id"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Cliente
            </label>

            <select name="usuario_id"
                    id="usuario_id"
                    class="form-select"
                    required
                    style="border: 1px solid #ccc;
                           border-radius: 5px;
                           font-size: 13px;
                           height: 40px;
                           padding: 7px 12px;">

                <option value="">Selecione um cliente</option>

                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ old('usuario_id', $data->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach

            </select>

            @error('usuario_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>

        {{-- Data --}}
        <div class="mb-3">

            <label for="data"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Data do Pedido
            </label>

            <input type="date"
                   name="data"
                   id="data"
                   required
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('data', isset($data->data) ? \Illuminate\Support\Carbon::parse($data->data)->format('Y-m-d') : '') }}">

            @error('data')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>
        
       {{-- Prazo de Entrega --}}
        <div class="mb-3">

            <label for="prazo_entrega"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Prazo de Entrega
            </label>

            <input type="date"
                   name="prazo_entrega"
                   id="prazo_entrega"
                   required
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('prazo_entrega', isset($data->prazo_entrega) ? \Illuminate\Support\Carbon::parse($data->prazo_entrega)->format('Y-m-d') : '') }}">

            @error('prazo_entrega')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>

        {{-- Valor Total --}}
        <div class="mb-3">

            <label for="valor_total"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Valor Total (R$)
            </label>

            <input type="number"
                   name="valor_total"
                   id="valor_total"
                   step="0.01"
                   min="0"
                   required
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="{{ old('valor_total', $data->valor_total ?? '') }}">

            @error('valor_total')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>

        {{-- Status --}}
        <div class="mb-3">

            <label for="status"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Status
            </label>

            <select name="status"
                    id="status"
                    required
                    class="form-select"
                    style="border: 1px solid #ccc;
                           border-radius: 5px;
                           font-size: 13px;
                           height: 40px;
                           padding: 7px 12px;">

                <option value="">Selecione o status</option>

                <option value="PENDENTE"
                    {{ old('status', $data->status ?? 'PENDENTE') == 'PENDENTE' ? 'selected' : '' }}>
                    PENDENTE
                </option>

                <option value="PAGO"
                    {{ old('status', $data->status ?? '') == 'PAGO' ? 'selected' : '' }}>
                    PAGO
                </option>

                <option value="EM_PRODUCAO"
                    {{ old('status', $data->status ?? '') == 'EM_PRODUCAO' ? 'selected' : '' }}>
                    EM PRODUÇÃO
                </option>

                <option value="ENVIADO"
                    {{ old('status', $data->status ?? '') == 'ENVIADO' ? 'selected' : '' }}>
                    ENVIADO
                </option>

                <option value="ENTREGUE"
                    {{ old('status', $data->status ?? '') == 'ENTREGUE' ? 'selected' : '' }}>
                    ENTREGUE
                </option>

            </select>

            @error('status')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>

        <div style="text-align: center;">

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

            <a href="{{ url('pedido') }}"
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