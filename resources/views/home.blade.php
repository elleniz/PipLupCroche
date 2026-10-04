@extends('cliente.main')

@section('titulo', 'PipLup Crochê')

@section('conteudo')

<div class="container mt-4">

    <h1 class="text-center">
        Bem-vindo à PipLup Crochê
    </h1>

    <p class="text-center">
        Confira nossos produtos e coleções.
    </p>

    <div class="text-center mt-4">

        <a
            href="{{ route('cliente.produtos') }}"
            class="btn"
            style="
                background-color: #ed8eaa;
                color: white;
                border-radius: 20px;
                padding: 10px 25px;
            "
        >
            Ver produtos
        </a>

    </div>

</div>

@endsection