@extends('main')

@section('titulo', 'Formulário de Compras')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    @php
        $data = $data ?? null;

        $action = !empty($data->id)
            ? route('compras.update', $data->id)
            : route('compras.store');

        $materiaisSelecionados = old(
            'materiais',
            isset($data->materiais)
                ? $data->materiais->pluck('id')->toArray()
                : ['']
        );

        $quantidadesSelecionadas = old(
            'quantidades',
            isset($data->materiais)
                ? $data->materiais->pluck('pivot.quantidade')->toArray()
                : [1]
        );
    @endphp


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            {{ !empty($data->id) ? 'EDITAR COMPRA' : 'CADASTRAR COMPRA' }}
        </h4>

        <p style="color: #555; font-size: 13px; margin-bottom: 0;">
            Cadastre ou atualize uma compra
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

                <label for="fornecedor"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Fornecedor
                </label>

                <input type="text"
                       name="fornecedor"
                       id="fornecedor"
                       class="form-control"
                       required
                       style="font-size: 13px; height: 40px;"
                       value="{{ old('fornecedor', $data->fornecedor ?? '') }}">

                @error('fornecedor')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

            </div>


            <div class="mb-3">

                <label for="data_compra"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Data da compra
                </label>

                <input type="date"
                       name="data_compra"
                       id="data_compra"
                       class="form-control"
                       required
                       style="font-size: 13px; height: 40px;"
                       value="{{ old('data_compra', isset($data->data_compra) && $data->data_compra ? \Illuminate\Support\Carbon::parse($data->data_compra)->format('Y-m-d') : '') }}">

                @error('data_compra')
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
                ADICIONAR MATERIAIS À COMPRA
            </h4>

            <p style="color: #555; font-size: 13px; margin-bottom: 0;">
                Adicione os materiais e informe as quantidades desejadas.
                O valor total será calculado automaticamente.
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

                            <label class="form-label"
                                   style="font-size: 13px;">
                                Material
                            </label>

                            <select name="materiais[]"
                                    class="form-select material-select"
                                    required
                                    style="font-size: 13px;"
                                    onchange="calcularTotal()">

                                <option value="">Selecione um material</option>

                                @foreach ($materiais as $material)

                                    <option value="{{ $material->id }}"
                                            data-valor="{{ $material->valor_unitario }}"
                                            {{ $materialSelecionado == $material->id ? 'selected' : '' }}>

                                        {{ $material->nome_material }}
                                        - R$ {{ number_format($material->valor_unitario, 2, ',', '.') }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="col-2">

                            <label class="form-label"
                                   style="font-size: 13px;">
                                Quantidade
                            </label>

                            <input type="number"
                                   name="quantidades[]"
                                   class="form-control quantidade-material"
                                   min="1"
                                   required
                                   value="{{ $quantidadesSelecionadas[$indice] ?? 1 }}"
                                   style="font-size: 13px;"
                                   oninput="calcularTotal()">

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
                                Remover material
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
                Adicionar novo material
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


            <div class="mb-3 mt-4">

                <label for="valor_total"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Valor total da compra
                </label>

                <input type="text"
                       id="valor_total"
                       class="form-control"
                       value="R$ 0,00"
                       readonly
                       style="font-size: 13px;
                              height: 40px;
                              background-color: #faf9f900;">

            </div>

            <p style="font-size: 12px; color: #666;">
                O valor total será calculado com base nos materiais
                selecionados e nas quantidades informadas.
            </p>


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

                <a href="{{ route('compras.index') }}"
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

<!--js-->
<script>
    function adicionarItem() {
        //
        const itens = document.getElementById('itens');//pega classe item
        const primeiro = itens.querySelector('.item');
        const novo = primeiro.cloneNode(true);

        novo.querySelector('select').value = '';//p poder escol her outro
        novo.querySelector('input').value = 1;

        itens.appendChild(novo);

        calcularTotal();
    }

    function removerItem(botao) {
        const itens = document.getElementById('itens');

        if (itens.querySelectorAll('.item').length > 1) {
            botao.closest('.item').remove();
            calcularTotal();
        }
    }

    function calcularTotal() {
        let total = 0;

        document.querySelectorAll('#itens .item').forEach(function (item) {
            const select = item.querySelector('.material-select');
            const quantidadeCampo = item.querySelector('.quantidade-material');

            const opcao = select.options[select.selectedIndex];
            const valor = parseFloat(opcao.dataset.valor) || 0;
            const quantidade = parseInt(quantidadeCampo.value) || 0;

            if (quantidade > 0) {
                total += valor * quantidade;
            }
        });

        document.getElementById('valor_total').value =
            total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
    }

    calcularTotal();
</script>

@stop