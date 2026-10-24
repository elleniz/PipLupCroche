@extends('main')

@section('titulo', 'Listagem de Materiais')

@section('conteudo')

<div style="background-color: #fffaf6; min-height: 100vh; padding-bottom: 40px;">

    <div class="row"
         style="background-color: #fffaf6; padding: 30px 40px;">

        <h3 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Listagem de Materiais
        </h3>

        <form action="{{ route('materiais.search') }}" method="post">
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

                        <option value="nome_material" {{ old('tipo') == 'nome_material' ? 'selected' : '' }}>Nome</option>
                        <option value="marca_material" {{ old('tipo') == 'marca_material' ? 'selected' : '' }}>Marca</option>
                        <option value="tipo_material" {{ old('tipo') == 'tipo_material' ? 'selected' : '' }}>Tipo</option>
                        <option value="valor_unitario" {{ old('tipo') == 'valor_unitario' ? 'selected' : '' }}>Valor unitário</option>
                        <option value="qtd_estoque" {{ old('tipo') == 'qtd_estoque' ? 'selected' : '' }}>Quantidade em estoque</option>

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

                    <a href="{{ url('materiais/create') }}"
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

    @if (session('success'))
        <div class="alert alert-success mx-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-4"
         style="padding: 0 40px;">

        <table class="table table-hover"
               style="width: 100%;
                      font-size: 14px;
                      color: #555;
                      border: 1px solid #e2d9d5;
                      background-color: white;">

            <thead>
                <tr style="background-color: #fffaf6;">

                    <th scope="col"
                        style="padding: 16px;">
                        #
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Nome
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Marca
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Tipo
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Valor unitário
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Estoque
                    </th>

                    <th scope="col"
                        style="padding: 16px;
                               text-align: center;">
                        Ação
                    </th>

                    <th scope="col"
                        style="padding: 16px;
                               text-align: center;">
                        Ação
                    </th>

                </tr>
            </thead>

            <tbody>

                @foreach ($dados as $item)


                    <tr style="background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->id }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->nome_material }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->marca_material }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->tipo_material }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->qtd_estoque }}
                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                            <a class="btn"
                               title="Editar"
                               href="{{ route('materiais.edit', $item->id) }}"
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

                            <form action="{{ route('materiais.destroy', $item->id) }}"
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
                                        onclick='return confirm("Deseja Excluir?")'>
                                    Deletar
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop