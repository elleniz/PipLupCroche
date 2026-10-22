@extends('main')

@section('titulo', 'Formulário de Venda')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php
        $action = !empty($data->id)
            ? route('vendas.update', $data->id)
            : route('vendas.store');

        $produtosSelecionados = old(
            'produtos',
            isset($data) ? $data->produtos->pluck('id')->toArray() : ['']
        );

        $quantidadesSelecionadas = old(
            'quantidades',
            isset($data) ? $data->produtos->pluck('pivot.quantidade')->toArray() : [1]
        );
    @endphp

    <div style="text-align: center; margin-bottom: 20px;">
        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            {{ !empty($data->id) ? 'ATUALIZAR PEDIDO' : 'CADASTRAR PEDIDO' }}
        </h4>

        <p style="color: #555; font-size: 13px; margin-bottom: 0;">
            Cadastre ou atualize um venda
        </p>
    </div>

    <form action="{{ $action }}" method="POST">
        @csrf

        @if (!empty($data->id))
            @method('PUT')
        @endif

        {{-- PRIMEIRO CONTÊINER: DADOS DO PEDIDO --}}
        <div class="p-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            {{-- CLIENTE --}}
            <div class="mb-3">
                <label for="usuario_id" class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Cliente
                </label>

                <select name="usuario_id" id="usuario_id"
                        class="form-select" required
                        style="font-size: 13px; height: 40px;">

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

            {{-- DATA --}}
            <div class="mb-3">
                <label for="data" class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Data do Venda
                </label>

                <input type="date" name="data" id="data" required
                       class="form-control"
                       style="font-size: 13px; height: 40px;"
                       value="{{ old('data', isset($data->data) ? \Illuminate\Support\Carbon::parse($data->data)->format('Y-m-d') : '') }}">

                @error('data')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- PRAZO DE ENTREGA --}}
            <div class="mb-3">
                <label for="prazo_entrega" class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Prazo de Entrega
                </label>

                <input type="date" name="prazo_entrega" id="prazo_entrega"
                       class="form-control"
                       style="font-size: 13px; height: 40px;"
                       value="{{ old('prazo_entrega', isset($data->prazo_entrega) && $data->prazo_entrega ? \Illuminate\Support\Carbon::parse($data->prazo_entrega)->format('Y-m-d') : '') }}">

                @error('prazo_entrega')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <label for="status" class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Status
                </label>

                <select name="status" id="status" required
                        class="form-select"
                        style="font-size: 13px; height: 40px;">

                    <option value="">Selecione o status</option>

                    @foreach ([
                        'PENDENTE' => 'PENDENTE',
                        'PAGO' => 'PAGO',
                        'EM_PRODUCAO' => 'EM PRODUÇÃO',
                        'ENVIADO' => 'ENVIADO',
                        'ENTREGUE' => 'ENTREGUE'
                    ] as $valor => $descricao)

                        <option value="{{ $valor }}"
                            {{ old('status', $data->status ?? 'PENDENTE') == $valor ? 'selected' : '' }}>
                            {{ $descricao }}
                        </option>

                    @endforeach

                </select>

                @error('status')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- TÍTULO DOS PRODUTOS --}}
        <div style="text-align: center; margin-bottom: 20px;">
            <h4 style="color: #6d3f36;
                       font-family: Georgia, serif;
                       font-weight: bold;
                       margin-bottom: 8px;
                       margin-top: 30px;">
                ADICIONAR PRODUTOS AO PEDIDO
            </h4>

            <p style="color: #555; font-size: 13px; margin-bottom: 0;">
                Favor adicionar ao menos um produto ao venda.
                O valor total é calculado automaticamente.
            </p>
        </div>

        {{-- SEGUNDO CONTÊINER: PRODUTOS --}}
        <div class="p-4 mt-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            <div id="itens">

                @foreach ($produtosSelecionados as $indice => $produtoSelecionado)

                    <div class="item row mb-3 align-items-end">

                        <div class="col-7">
                            <label class="form-label" style="font-size: 13px;">
                                Produto
                            </label>

                            <select name="produtos[]" class="form-select"
                                    required style="font-size: 13px;">

                                <option value="">Selecione um produto</option>

                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}"
                                        {{ $produtoSelecionado == $produto->id ? 'selected' : '' }}>
                                        {{ $produto->nome }} -
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-2">
                            <label class="form-label" style="font-size: 13px;">
                                Quantidade
                            </label>

                            <input type="number"
                                   name="quantidades[]"
                                   class="form-control"
                                   min="1"
                                   required
                                   value="{{ $quantidadesSelecionadas[$indice] ?? 1 }}"
                                   style="font-size: 13px;">
                        </div>

                        <div class="col-3">
                            <button type="button"
                                    class="btn"
                                    onclick="removerItem(this)"
                                    style="background-color: transparent;
                                           border: 1px solid #c90045;
                                           border-radius: 20px;
                                           color: #c90045;
                                           padding: 8px 10px;
                                           font-size: 11px;
                                           width: 100%;">
                                - Remover produto
                            </button>
                        </div>

                    </div>

                @endforeach

            </div>

            <button type="button"
                    class="btn btn-sm mb-3"
                    onclick="adicionarItem()"
                    style="background-color: #e88da5;
                           color: #FFFFFF;
                           font-size: 13px;
                           border: none;
                           border-radius: 20px;
                           padding: 8px 16px;">
                + Adicionar novo produto
            </button>

            @error('produtos')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @error('quantidades')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @foreach ($errors->get('produtos.*') as $mensagens)
                @foreach ($mensagens as $mensagem)
                    <div class="text-danger small">{{ $mensagem }}</div>
                @endforeach
            @endforeach

            @foreach ($errors->get('quantidades.*') as $mensagens)
                @foreach ($mensagens as $mensagem)
                    <div class="text-danger small">{{ $mensagem }}</div>
                @endforeach
            @endforeach

            <p style="font-size: 12px; color: #666;">
                O valor total será calculado automaticamente com base nos produtos
                e nas quantidades informadas.
            </p>

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

                <a href="{{ url('vendas') }}"
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

<script>
    function adicionarItem() {
        const itens = document.getElementById('itens');
        const primeiro = itens.querySelector('.item');
        const novo = primeiro.cloneNode(true);

        novo.querySelector('select').value = '';
        novo.querySelector('input').value = 1;

        itens.appendChild(novo);
    }

    function removerItem(botao) {
        const itens = document.getElementById('itens');

        if (itens.querySelectorAll('.item').length > 1) {
            botao.closest('.item').remove();
        }
    }
</script>

@stop