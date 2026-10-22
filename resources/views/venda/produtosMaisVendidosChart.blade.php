
@extends('main')

@section('titulo', 'Produtos Mais Vendidos')

@section('conteudo')
    <div class="container mt-4">
        <h2 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Produtos Mais Vendidos
        </h2>

        <div class="card p-4 mt-3">
            {!! $chart->container() !!}
        </div>
    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
