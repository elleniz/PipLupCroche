@extends('main')

@section('titulo', 'Listagem de Categorias')

@section('conteudo')

<div style="background-color: #fffaf6; min-height: 100vh; padding-bottom: 40px;">

    <div class="row"
         style="background-color: #fffaf6; padding: 30px 40px;">

        <h3 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Listagem de Categorias
        </h3>

        <form action="{{ route('categoria.search') }}" method="post">
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

                        <option value="nome">Nome</option>
                        <option value="descricao">Descrição</option>
                        <option value="tipo">Tipo</option>
                        <option value="produto">Produto</option>

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

                    <a href="{{ url('categoria/create') }}"
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
                        Descricao
                    </th>

                    <th scope="col"
                        style="padding: 16px;">
                        Tipo
                    </th>
                    <th scope="col"
                        style="padding: 16px;">
                        Produto
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

                        <th scope="row"
                            style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->id }}
                        </th>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->nome }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->descricao}}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->tipo }}
                        </td>

                        <td style="padding: 16px;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">
                            {{ $item->produto->nome ?? 'Nenhum produto' }}
                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: {{ $loop->odd ? '#f4dada' : '#fff4f1' }};">

                            <a class="btn"
                               title="Editar"
                               href="{{ route('categoria.edit', $item->id) }}"
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

                            <form action="{{ route('categoria.destroy', $item->id) }}"
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
