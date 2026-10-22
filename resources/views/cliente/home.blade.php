@extends('cliente.main')

@section('titulo', 'PipLup Crochê')

@section('conteudo')

<!-- Cabeçalho do cliente -->
<div
    class="container-fluid py-4"
    style="
        background-color: #fffaf8;
        min-height: 100vh;
    "
>

    <div class="container">
z
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h1
                    class="fw-bold mb-1"
                    style="color: #76545c;"
                >
                    Bem-vindo à PipLup Crochê
                </h1>

                <p
                    class="mb-0"
                    style="color: #a7838b;"
                >
                    Olá, {{ session('cliente_nome', 'Cliente') }}!
                    Confira nossos produtos e novidades.
                </p>

            </div>

        </div>

    </div>

<div style="background-color: #fff6ed;">

    {{-- MENSAGEM DE SUCESSO --}}
    @if (session('success'))
        <div class="container pt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fechar">
                </button>
            </div>
        </div>
    @endif

    {{-- MENSAGEM DE ERRO --}}
    @if (session('error'))
        <div class="container pt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fechar">
                </button>
            </div>
        </div>
    @endif

    {{-- ERROS DE VALIDAÇÃO --}}
    @if ($errors->any())
        <div class="container pt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>Por favor, verifique os erros abaixo:</strong>

                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fechar">
                </button>

            </div>
        </div>
    @endif

    <main class="container mt-0">

        {{-- CARROSSEL --}}
        <div
            id="carouselPipLup"
            class="carousel slide"
            data-bs-ride="carousel">

            <div class="carousel-indicators">

                <button
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide-to="0"
                    class="active"
                    aria-current="true"
                    aria-label="Slide 1">
                </button>

                <button
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide-to="1"
                    aria-label="Slide 2">
                </button>

                <button
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide-to="2"
                    aria-label="Slide 3">
                </button>

                <button
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide-to="3"
                    aria-label="Slide 4">
                </button>

            </div>

            <div class="carousel-inner rounded">

                <div class="carousel-item active">
                    <img
                        src="{{ asset('image/header1.png') }}"
                        class="d-block w-100"
                        alt="Coleção maresia: peças de crochê com ondas"
                        style="height: 300px; object-fit: cover;">
                </div>

                <div class="carousel-item">
                    <img
                        src="{{ asset('image/header2.png') }}"
                        class="d-block w-100"
                        alt="Coleção vintage: peças de crochê com tons terrosos"
                        style="height: 300px; object-fit: cover;">
                </div>

                <div class="carousel-item">
                    <img
                        src="{{ asset('image/header3.png') }}"
                        class="d-block w-100"
                        alt="Coleção sapinhos: peças de crochê com sapinhos"
                        style="height: 300px; object-fit: cover;">
                </div>

                <div class="carousel-item">
                    <img
                        src="{{ asset('image/header4.png') }}"
                        class="d-block w-100"
                        alt="Coleção Casa da Vovó: peças de crochê para sua casa"
                        style="height: 300px; object-fit: cover;">
                </div>

            </div>

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselPipLup"
                data-bs-slide="prev">

                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true">
                </span>

                <span class="visually-hidden">
                    Anterior
                </span>

            </button>

            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselPipLup"
                data-bs-slide="next">

                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true">
                </span>

                <span class="visually-hidden">
                    Próximo
                </span>

            </button>

        </div>

        {{-- ===================================================== --}}
        {{-- LANÇAMENTO --}}
        {{-- ===================================================== --}}

        @php
            $lancamentos = [
                [
                    'imagem' => 'imagem_1.jpg',
                    'nome' => 'Suéter pp | Estrela Listrada - marrom',
                    'preco' => 'R$ 290,00',
                    'detalhe' => 'Em até 2x de R$ 145,00',
                    'alt' => 'Suéter marrom com estrela',
                ],
                [
                    'imagem' => 'imagem_2.jpg',
                    'nome' => 'Baby tee | Estrela - marrom',
                    'preco' => 'R$ 100,00',
                    'detalhe' => 'Em até 2x de R$ 50,00',
                    'alt' => 'Baby tee marrom escura com estrela',
                ],
                [
                    'imagem' => 'imagem_4.jpg',
                    'nome' => 'Bolsa xadrez | Quadradinha - marrom',
                    'preco' => 'R$ 67,00',
                    'detalhe' => 'De R$ 67,00 no PIX',
                    'alt' => 'Bolsa xadrez em tons de marrom e bege',
                ],
                [
                    'imagem' => 'imagem_3.jpg',
                    'nome' => 'Bolsa de malha | marrom',
                    'preco' => 'R$ 55,00',
                    'detalhe' => 'De R$ 55,00 no PIX',
                    'alt' => 'Bolsa de fio de malha marrom',
                ],
                [
                    'imagem' => 'imagem_5.jpg',
                    'nome' => 'Sousplat petal | marrom',
                    'preco' => 'R$ 30,00',
                    'detalhe' => 'De R$ 30,00 no PIX',
                    'alt' => 'Sousplat marrom em formato de pétalas de flor',
                ],
            ];

            $maisVendidos = [
                [
                    'imagem' => 'imagem_6.jpg',
                    'nome' => 'Scrunchies | Multicolor - unitário',
                    'preco' => 'R$ 15,00',
                    'detalhe' => 'R$ 13,50 cada comprando 3 ou +',
                    'alt' => 'Scrunchies multicoloridas de crochê',
                ],
                [
                    'imagem' => 'imagem_7.jpg',
                    'nome' => 'Bolsinha Snoopy',
                    'preco' => 'R$ 60,00',
                    'detalhe' => 'Em até 2x de R$ 30,00',
                    'alt' => 'Bolsinha de crochê inspirada no Snoopy',
                ],
                [
                    'imagem' => 'imagem_8.jpg',
                    'nome' => 'Ursinhos Carinhosos P',
                    'preco' => 'R$ 65,00',
                    'detalhe' => 'Até 2x de R$ 32,50',
                    'alt' => 'Ursinhos Carinhosos multicoloridos em crochê',
                ],
                [
                    'imagem' => 'imagem_9.jpg',
                    'nome' => 'Amigurumi Laboon | One Piece',
                    'preco' => 'R$ 150,00',
                    'detalhe' => 'Ou 2x de R$ 75,00',
                    'alt' => 'Amigurumi baleia Laboon',
                ],
                [
                    'imagem' => 'imagem_10.jpg',
                    'nome' => 'Cropped Angélica G - Amarelo',
                    'preco' => 'R$ 75,00',
                    'detalhe' => 'Até 2x de R$ 37,50',
                    'alt' => 'Cropped alaranjado em crochê',
                ],
            ];

            $casaVovo = [
                [
                    'imagem' => 'imagem_11.jpg',
                    'nome' => 'Tapete Hexágono | Monocromático cinza',
                    'preco' => 'R$ 100,00',
                    'detalhe' => 'Até 2x de R$ 50,00',
                    'alt' => 'Tapete hexágonos monocromáticos cinzas em crochê',
                ],
                [
                    'imagem' => 'imagem_12.jpg',
                    'nome' => 'Tapete Rainbow - Terracota',
                    'preco' => 'R$ 80,00',
                    'detalhe' => 'Até 2x de R$ 40,00',
                    'alt' => 'Tapete arco-íris em tons de terracota',
                ],
                [
                    'imagem' => 'imagem_13.jpg',
                    'nome' => 'Tapete Estrela | Azul',
                    'preco' => 'R$ 80,00',
                    'detalhe' => 'Ou R$ 75,00 no PIX',
                    'alt' => 'Tapete em formato de estrela em tons de azul',
                ],
                [
                    'imagem' => 'imagem_14.jpg',
                    'nome' => 'Tapete Retângulo | Love',
                    'preco' => 'R$ 40,00',
                    'detalhe' => 'R$ 35,00 no PIX',
                    'alt' => 'Tapete retangular vermelho com corações',
                ],
                [
                    'imagem' => 'imagem_15.jpg',
                    'nome' => 'Tapete Homem Aranha',
                    'preco' => 'R$ 180,00',
                    'detalhe' => 'Até 2x de R$ 90,00',
                    'alt' => 'Tapete vermelho e azul inspirado no Homem-Aranha',
                ],
            ];
        @endphp

        {{-- ===================================================== --}}
        {{-- FUNÇÃO VISUAL DOS CARDS --}}
        {{-- ===================================================== --}}

        @foreach ([
            'LANÇAMENTO' => $lancamentos,
            'MAIS VENDIDOS' => $maisVendidos,
            'COLEÇÃO CASA DE VOVÓ' => $casaVovo
        ] as $tituloSecao => $produtos)

            <section class="mb-5 mt-5">

                <h2
                    class="text-center mb-4"
                    style="
                        color: #55504d;
                        font-family: Georgia, serif;
                        font-size: 22px;
                        letter-spacing: 1px;
                    ">
                    {{ $tituloSecao }}
                </h2>

                <div class="row justify-content-center g-4">

                    @foreach ($produtos as $produto)

                        <div class="col-6 col-sm-4 col-md-3 col-lg">

                            <div
                                class="card h-100"
                                style="
                                    background-color: #fffaf6;
                                    border: 1px solid #eee3dc;
                                    border-radius: 0;
                                ">

                                <img
                                    src="{{ asset('image/' . $produto['imagem']) }}"
                                    class="card-img-top"
                                    style="
                                        height: 250px;
                                        object-fit: cover;
                                        padding: 8px;
                                    "
                                    alt="{{ $produto['alt'] }}">

                                <div class="card-body text-center p-2">

                                    <p
                                        class="card-text mb-1"
                                        style="
                                            color: #59443d;
                                            font-size: 11px;
                                        ">
                                        {{ $produto['nome'] }}
                                    </p>

                                    <h5
                                        class="mb-1"
                                        style="
                                            color: #e38b9a;
                                            font-size: 15px;
                                        ">
                                        {{ $produto['preco'] }}
                                    </h5>

                                    <small
                                        style="
                                            color: #777;
                                            font-size: 8px;
                                        ">
                                        {{ $produto['detalhe'] }}
                                    </small>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

        @endforeach

    </main>

</div>
</div>
@endsection