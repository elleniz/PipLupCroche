<!doctype html>

<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('titulo', 'PipLup Crochê ADM'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>


<body style="background-color: #fff6ed;">

    <?php echo $__env->make('header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <main class="container mt-0"  style="background-color: #fff6ed;"> <!--cor da main aqui-->

        <div class="col-12 col-md-9">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show"
                    role="alert">
                    <?php echo e(session('success')); ?>

                    <button class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="fechar">
                    </button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show"
                    role="alert">
                    <?php echo e(session('error')); ?>

                    <button class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="fechar">
                    </button>
                </div>
            <?php endif; ?>

        </div>



        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <b>Por favor, verifique os erros abaixo</b>
                <ul class="mb-0 mt-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <button class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="fechar">
                </button>

            </div>
        <?php endif; ?>

        <?php if(request()->is('/')): ?> <!-- se é a página inicial -->

<!--carrossel-->
            <div id="carouselPipLup"
                class="carousel slide"
                data-bs-ride="carousel">

                <div class="carousel-indicators">

                    <button type="button"
                        data-bs-target="#carouselPipLup"
                        data-bs-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="Slide 1">
                    </button>

                    <button type="button"
                        data-bs-target="#carouselPipLup"
                        data-bs-slide-to="1"
                        aria-label="Slide 2">
                    </button>

                    <button type="button"
                        data-bs-target="#carouselPipLup"
                        data-bs-slide-to="2"
                        aria-label="Slide 3">
                    </button>

                    <button type="button"
                        data-bs-target="#carouselPipLup"
                        data-bs-slide-to="3"
                        aria-label="Slide 4">
                    </button>

                </div>


                <div class="carousel-inner rounded">

                    <div class="carousel-item active">

                        <img src="<?php echo e(asset('image/header1.png')); ?>"
                            class="d-block w-100"
                            alt="Coleção maresia: peças de crochê com ondas"
                            style="height: 300;">
                    </div>


                    <div class="carousel-item">

                        <img src="<?php echo e(asset('image/header2.png')); ?>"
                            class="d-block w-100"
                            alt="Coleção vintage: peças de crochê com tons terrosos"
                            style="height: 300;">

                    </div>

                    <div class="carousel-item">

                        <img src="<?php echo e(asset('image/header3.png')); ?>"
                            class="d-block w-100"
                            alt="Coleção sapinhos: peças de crochê com sapinhos"                            
                            style="height: 300;">


                    </div>

                    <div class="carousel-item">

                        <img src="<?php echo e(asset('image/header4.png')); ?>"
                            class="d-block w-100"
                            alt="Coleção casa da vovó: peças de crochê como tapetes e sousplats para sua casa"               
                            style="height: 300;">


                    </div>

                </div>

                <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"
                        aria-hidden="true">
                    </span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>



                <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselPipLup"
                    data-bs-slide="next">

                    <span class="carousel-control-next-icon"
                        aria-hidden="true">
                    </span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>

            </div>


<!--parte debaixo-->

            <section class="mb-5">
                <h2 class="text-center mb-4"
                    style="
                        color: #55504d;
                        font-family: Georgia, serif;
                        font-size: 22px;
                        letter-spacing: 1px;
                    ">
                    LANÇAMENTO
                </h2>

<!--parte com cards de lançamento-->
                <div class="row justify-content-center g-4">
                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">

                            <img src="<?php echo e(asset('image/imagem_1.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Suéter marrom com estrela">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Suéter pp | Estrela Listrada - marrom

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 290,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Em até 2x de R$ 145,00

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_2.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Baby tee marrom escura com estrela">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Baby tee | Estrela - marrom

                                </p>
<!--parte do preço-->

                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 100,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Em até 2x de R$ 50,00

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">

                            <img src="<?php echo e(asset('image/imagem_4.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Bolsa xadrez em tons de marrom e bege">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Bolsa xadrez | Quadradinha - marrom

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 67,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    De R$ 67,00 no PIX

                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_3.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Bolsa de fio de malha marrom e pequena">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Bolsa de malha | marrom

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 55,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    De R$ 55,00 no PIX

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_5.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Sousplat marrom em formato de pétalas de flor">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Sousplat petal | marrom

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 30,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    De R$ 30,00 no PIX

                                </small>

                            </div>

                        </div>

                    </div>


                </div>

            </section>

<!--mais vendidos cards parte 2-->

            <section class="mb-5">

                <h2 class="text-center mb-4"
                    style="
                        color: #55504d;
                        font-family: Georgia, serif;
                        font-size: 22px;
                        letter-spacing: 1px;
                    ">
                    MAIS VENDIDOS
                </h2>

                <div class="row justify-content-center g-4">

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">

                            <img src="<?php echo e(asset('image/imagem_6.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Scrunchies (xuxinhas de cabelo) marrom, bege e branco feitas com crochê">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Scrunchies | Multicolor - unitário

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 15,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    R$ 13,50 cada comprando 3 ou +

                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_7.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Bolsinha de crochê que inspirada no Snoppy">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Bolsinha Snoopy

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 60,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Em até 2x de R$ 30,00

                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_8.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="6 Ursinhos Carinhosos multicolor em crochê">

                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Ursinhos Carinhosos P

                                </p>
<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 65,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Até 2x de R$ 32,50

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_9.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Amigurumi baleia Laboon">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Amigurumi Laboon | One Piece

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 150,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Ou 2x de R$ 75,00

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_10.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Cropped alaranjado em crochê">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Cropped Angélica G - Amarelo

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 75,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Até 2x de R$ 37,50

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="mb-5">

<!--parte 3 dos cards -->
                <h2 class="text-center mb-4"
                    style="
                        color: #55504d;
                        font-family: Georgia, serif;
                        font-size: 22px;
                        letter-spacing: 1px;
                    ">

                    COLEÇÃO CASA DE VOVÓ

                </h2>

                <div class="row justify-content-center g-4">

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_11.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Tapete Hexágonos monocromáticos cinzas em crochê">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Tapete Hexágono | Monocromático cinza

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 100,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Até 2x de R$ 50,00

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_12.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Tapete de crochê em formato de arco-íris com tons de terracota">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Tapete Rainbow - Terracota

                                </p>

<!--parte do preço-->
                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 80,00

                                </h5>

<!--desconto-->
                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Até 2x de R$ 40,00

                                </small>

                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_13.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Tapete em formato de estrela em tons de azul">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Tapete Estrela | Azul

                                </p>


                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 80,00

                                </h5>


                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Ou R$ 75,00 no PIX

                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_14.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Tapete de crochê retangular vermelho com corações">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Tapete Retângulo | Love

                                </p>


                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 40,00

                                </h5>


                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    R$ 35,00 no PIX

                                </small>

                            </div>

                        </div>

                    </div>




                    <div class="col-6 col-sm-4 col-md-3 col-lg">

                        <div class="card h-100"
                            style="
                                background-color: #fffaf6;
                                border: 1px solid #eee3dc;
                                border-radius: 0;
                            ">


                            <img src="<?php echo e(asset('image/imagem_15.jpg')); ?>"
                                class="card-img-top"
                                style="
                                    height: 250px;
                                    object-fit: cover;
                                    padding: 8px;
                                "
                                alt="Tapete em vermelho e azul inspirado no homem-aranha">


                            <div class="card-body text-center p-2">

                                <p class="card-text mb-1"
                                    style="
                                        color: #59443d;
                                        font-size: 11px;
                                    ">

                                    Tapete Homem Aranha

                                </p>


                                <h5 class="mb-1"
                                    style="
                                        color: #e38b9a;
                                        font-size: 15px;
                                    ">

                                    R$ 180,00

                                </h5>


                                <small style="
                                    color: #777;
                                    font-size: 8px;
                                ">

                                    Até 2x de R$ 90,00

                                </small>

                            </div>

                        </div>

                    </div>


                </div>

            </section>

        <?php endif; ?>

        <?php echo $__env->yieldContent('conteudo'); ?>

    </main>

        <?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/main.blade.php ENDPATH**/ ?>