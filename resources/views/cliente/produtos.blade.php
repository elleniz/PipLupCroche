@extends('cliente.main')

@section('titulo', 'Produtos')

@section('conteudo')

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100vh;
            padding: 35px 40px;">

    <div class="text-center mb-4">

        <h3 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;">
            Nossos Produtos
        </h3>

        <p style="color: #777;
                  font-size: 14px;">
            Confira nossos produtos de crochê.
        </p>

    </div>

    <div class="row">

        @forelse ($dados as $item)

            <div class="col-md-4 col-lg-3 mb-4">

                <div class="card h-100"
                     style="border: 1px solid #ead5d5;
                            border-radius: 12px;
                            background-color: white;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.10);">

                    <div class="card-body text-center">

                        <h5 class="card-title"
                            style="color: #6d3f36;
                                   font-family: Georgia, serif;
                                   font-weight: bold;">
                            {{ $item->nome }}
                        </h5>

                        <p style="color: #777;
                                  font-size: 13px;
                                  margin-bottom: 8px;">
                            Categoria: {{ $item->categoria }}
                        </p>

                        <h5 style="color: #d90045;
                                   font-weight: bold;">
                            R$ {{ number_format($item->preco, 2, ',', '.') }}
                        </h5>

                        @if ($item->quantidade > 0)

                            <span class="badge"
                                  style="background-color: #e8bcc5;
                                         color: white;
                                         padding: 8px 12px;
                                         border-radius: 15px;">
                                Disponível
                            </span>

                        @else

                            <span class="badge"
                                  style="background-color: #d90045;
                                         color: white;
                                         padding: 8px 12px;
                                         border-radius: 15px;">
                                Indisponível
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center">

                <p style="color: #777;">
                    Nenhum produto disponível no momento.
                </p>

            </div>

        @endforelse

    </div>

    <div class="text-center mt-4">

        <a href="{{ route('cliente.inicio') }}"
           class="btn"
           style="background-color: #ed8eaa;
                  border: none;
                  border-radius: 20px;
                  color: white;
                  padding: 9px 25px;">
            Voltar
        </a>

    </div>

</div>

@stop