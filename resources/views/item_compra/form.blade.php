@extends('main')

@section('titulo', 'Formulário de Itens de Compra')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php
        $data = $data ?? null;

        $action = !empty($data->id)
            ? route('item_compra.update', $data->id)
            : route('item_compra.store');

        $materiaisSelecionados = old(
            'materiais',
            !empty($data->id) ? [$data->material_id] : ['']
        );

        $quantidadesSelecionadas = old(
            'quantidades',
            !empty($data->id) ? [$data->quantidade] : [1]
        );
    @endphp


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            {{ !empty($data->id) ? 'ATUALIZAR ITEM DE COMPRA' : 'CADASTRAR ITENS DE COMPRA' }}
        </h4>

        <p style="color: #555; font-size: 13px; margin-bottom: 0;">
            Selecione a compra, os materiais e as respectivas quantidades.
        </p>

    </div>

    <form action="{{ $action }}" method="POST">

        @csrf

        @if (!empty($data->id))
            @method('PUT')
        @endif


        <div class="p-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            <div class="mb-3">

                <label for="compra_id"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Compra
                </label>

                <select name="compra_id"
                        id="compra_id"
                        class="form-select"
                        required
                        style="font-size: 13px; height: 40px;">

                    <option value="">Selecione uma compra</option>

                    @foreach ($compras as $compra)

                        <option value="{{ $compra->id }}"
                            {{ old('compra_id', $data->compra_id ?? '') == $compra->id ? 'selected' : '' }}>

                            Compra #{{ $compra->id }}
                            - {{ $compra->fornecedor }}
                            - {{ \Illuminate\Support\Carbon::parse($compra->data_compra)->format('d/m/Y') }}

                        </option>

                    @endforeach

                </select>

                @error('compra_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

            </div>

        </div>


        <div style="text-align: center; margin-bottom: 20px;">

            <h4 style="color: #6d3f36;
                       font-family: Georgia, serif;
                       font-weight: bold;
                       margin-bottom: 8px;
                       margin-top: 30px;">
                MATERIAIS DA COMPRA
            </h4>

            <p style="color: #555; font-size: 13px; margin-bottom: 0;">
                Adicione os materiais que fazem parte desta compra.
            </p>

        </div>


        <div class="p-4 mt-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            <div id="itens">

                @foreach ($materiaisSelecionados as $indice => $materialSelecionado)

                    <div class="item row mb-3 align-items-end">

                        <div class="col-7">

                            <label class="form-label" style="font-size: 13px;">
                                Material
                            </label>

                            <select name="materiais[]"
                                    class="form-select"
                                    required
                                    style="font-size: 13px;">

                                <option value="">Selecione um material</option>

                                @foreach ($materiais as $material)

                                    <option value="{{ $material->id }}"
                                        {{ $materialSelecionado == $material->id ? 'selected' : '' }}>

                                        {{ $material->nome_material }}
                                        - R$ {{ number_format($material->valor_unitario, 2, ',', '.') }}

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
                                   step="1"
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
                                - Remover
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
                + Adicionar material
            </button>

            @error('materiais')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @error('quantidades')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            @foreach ($errors->get('materiais.*') as $mensagens)
                @foreach ($mensagens as $mensagem)
                    <div class="text-danger small">{{ $mensagem }}</div>
                @endforeach
            @endforeach

            @foreach ($errors->get('quantidades.*') as $mensagens)
                @foreach ($mensagens as $mensagem)
                    <div class="text-danger small">{{ $mensagem }}</div>
                @endforeach
            @endforeach

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

                <a href="{{ route('item_compra.list') }}"
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