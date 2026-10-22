@extends('main')

@section('titulo', 'Listagem de Venda')

@section('conteudo')

<div style="background-color: #fffaf6; min-height: 100vh; padding-bottom: 40px;">

    <div class="row"
         style="background-color: #fffaf6; padding: 30px 40px;">

        <h3 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Listagem de Venda
        </h3>

        <form action="{{ route('vendas.search') }}" method="post">
            @csrf

            <div class="row">

                <div class="col-2">
                    <label for="tipo"
                           style="color: #555;
                                  font-size: 13px;
                                  margin-bottom: 5px;">
                        Tipo
                    </label>

                    <select name="tipo"
                            id="tipo"
                            class="form-select"
                            style="border: 1px solid #aaa;
                                   border-radius: 20px;
                                   font-size: 13px;
                                   height: 40px;">

                        <option value="cliente"
                            {{ old('tipo') == 'cliente' ? 'selected' : '' }}>
                            Cliente
                        </option>

                        <option value="valor_total"
                            {{ old('tipo') == 'valor_total' ? 'selected' : '' }}>
                            Valor Total
                        </option>

                        <option value="data"
                            {{ old('tipo') == 'data' ? 'selected' : '' }}>
                            Data
                        </option>

                        <option value="status"
                            {{ old('tipo') == 'status' ? 'selected' : '' }}>
                            Status
                        </option>

                    </select>
                </div>

                <div class="col-5">
                    <label for="valor"
                           style="color: #555;
                                  font-size: 13px;
                                  margin-bottom: 5px;">
                        Valor
                    </label>

                    <input type="text"
                           name="valor"
                           id="valor"
                           value="{{ old('valor') }}"
                           placeholder="Pesquisar..."
                           class="form-control"
                           style="border: 1px solid #aaa;
                                  border-radius: 20px;
                                  font-size: 13px;
                                  height: 40px;
                                  padding-left: 15px;">
                </div>

                <div class="col-5"
                     style="padding-top: 25px;">

                <a href="{{ route('vendas.report') }}" class="btn btn-danger">
                    Gerar relatório PDF
                </a>
                <a href="{{ route('vendas.produtosMaisVendidosChart') }}" class="btn btn-danger">
                    Gerar grafico
                </a>
                    <button type="submit"
                            class="btn"
                            style="background-color: #ed8eaa;
                                   border: none;
                                   border-radius: 20px;
                                   color: white;
                                   font-size: 13px;
                                   padding: 9px 25px;">
                        Buscar
                    </button>

                    <a href="{{ route('vendas.create') }}"
                       class="btn"
                       style="background-color: #e8bcc5;
                              border: none;
                              border-radius: 20px;
                              color: white;
                              font-size: 13px;
                              padding: 9px 25px;">
                        Novo
                    </a>

                </div>

            </div>
        </form>

    </div>

    <div class="row mt-4"
         style="padding: 0 40px; overflow-x: auto;">

        <table class="table table-hover"
               style="width: 100%;
                      font-size: 14px;
                      color: #555;
                      border: 1px solid #e2d9d5;
                      background-color: white;">

            <thead>
                <tr style="background-color: #fffaf6;">

                    <th scope="col" style="padding: 16px;">#</th>
                    <th scope="col" style="padding: 16px;">Cliente</th>
                    <th scope="col" style="padding: 16px;">Produtos</th>
                    <th scope="col" style="padding: 16px;">Valor Total</th>
                    <th scope="col" style="padding: 16px;">Data</th>
                    <th scope="col" style="padding: 16px;">Prazo de Entrega</th>
                    <th scope="col" style="padding: 16px;">Status</th>

                    <th scope="col"
                        style="padding: 16px; text-align: center;">
                        Ação
                    </th>

                    <th scope="col"
                        style="padding: 16px; text-align: center;">
                        Ação
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse ($dados as $item)

                    <tr style="background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->id }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->usuario->nome ?? 'Sem cliente' }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                            @forelse ($item->produtos as $produto)
                                <div>
                                    {{ $produto->nome }}

                                    <span style="color: #777;">
                                        ({{ $produto->pivot->quantidade }} un.)
                                    </span>
                                </div>
                            @empty
                                Nenhum produto
                            @endforelse

                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            R$ {{ number_format($item->valor_total, 2, ',', '.') }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ \Illuminate\Support\Carbon::parse($item->data)->format('d/m/Y') }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->prazo_entrega
                                ? \Illuminate\Support\Carbon::parse($item->prazo_entrega)->format('d/m/Y')
                                : 'Não definido' }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ str_replace('_', ' ', $item->status) }}
                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                            <a class="btn"
                               title="Editar"
                               href="{{ route('vendas.edit', $item->id) }}"
                               style="background-color: #ed8eaa;
                                      border: none;
                                      border-radius: 20px;
                                      color: white;
                                      font-size: 13px;
                                      padding: 7px 18px;">
                                Editar
                            </a>

                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                            <form action="{{ route('vendas.destroy', $item->id) }}"
                                  method="post">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn"
                                        title="Excluir"
                                        style="background-color: #d90045;
                                               border: none;
                                               border-radius: 20px;
                                               color: white;
                                               font-size: 13px;
                                               padding: 7px 18px;"
                                        onclick="return confirm('Deseja excluir este venda?')">
                                    Deletar
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9"
                            style="text-align: center;
                                   padding: 25px;
                                   color: #777;">
                            Nenhum venda encontrado.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop