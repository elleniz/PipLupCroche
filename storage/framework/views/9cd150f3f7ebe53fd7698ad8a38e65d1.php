<?php $__env->startSection('titulo', 'Painel Administrativo - PipLup Crochê'); ?>

<?php $__env->startSection('conteudo'); ?>
<div class="container-fluid py-4"
     style="
        background-color: #fffaf8;
        min-height: 100vh;
     ">

    <!-- Cabeçalho do painel -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h1 class="fw-bold mb-1"
                style="color: #76545c;">

                Painel Administrativo

            </h1>

            <p class="mb-0"
               style="color: #a7838b;">

                Gerencie os produtos, clientes e configurações da loja.

            </p>
        </div>

        <span class="badge rounded-pill px-3 py-2"
              style="
                background-color: #ffe4eb;
                color: #c8798b;
                border: 1px solid #f3d6df;
              ">

            <i class="fa-solid fa-user-shield me-1"></i>
            Administrador

        </span>

    </div>


    <!-- Cards de resumo -->
    <div class="row g-4 mb-4">

        <!-- Produtos -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100"
                 style="
                    border-radius: 18px;
                    background: linear-gradient(135deg, #fffaf8, #fff0f3);
                    border: 1px solid #f3d6df !important;
                 ">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="mb-2"
                                style="color: #a7838b;">

                                Produtos

                            </h6>

                            <h2 class="fw-bold mb-0"
                                style="color: #76545c;">

                                Gerenciar

                            </h2>

                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="
                                width: 58px;
                                height: 58px;
                                border-radius: 16px;
                                background-color: #ffe4eb;
                                color: #e99aaa;
                             ">

                            <i class="fa-solid fa-box-open fa-2x"></i>

                        </div>

                    </div>

                    <a href="<?php echo e(url('/produto')); ?>"
                       class="btn btn-sm mt-4 px-3"
                       style="
                            background-color: #e99aaa;
                            color: white;
                            border-radius: 10px;
                       ">

                        <i class="fa-solid fa-arrow-right me-1"></i>
                        Ver produtos

                    </a>

                </div>

            </div>

        </div>


        <!-- Usuarios -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100"
                 style="
                    border-radius: 18px;
                    background: linear-gradient(135deg, #fffaf8, #fff0f3);
                    border: 1px solid #f3d6df !important;
                 ">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="mb-2"
                                style="color: #a7838b;">

                                Usuários

                            </h6>

                            <h2 class="fw-bold mb-0"
                                style="color: #76545c;">

                                Gerenciar

                            </h2>

                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="
                                width: 58px;
                                height: 58px;
                                border-radius: 16px;
                                background-color: #ffe4eb;
                                color: #e99aaa;
                             ">

                            <i class="fa-solid fa-users fa-2x"></i>

                        </div>

                    </div>

                    <a href="<?php echo e(url('/usuario')); ?>"
                       class="btn btn-sm mt-4 px-3"
                       style="
                            background-color: #e99aaa;
                            color: white;
                            border-radius: 10px;
                       ">

                        <i class="fa-solid fa-arrow-right me-1"></i>
                        Ver usuários

                    </a>

                </div>

            </div>

        </div>


        <!-- Configurações -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100"
                 style="
                    border-radius: 18px;
                    background: linear-gradient(135deg, #fffaf8, #fff0f3);
                    border: 1px solid #f3d6df !important;
                 ">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="mb-2"
                                style="color: #a7838b;">

                                Configurações

                            </h6>

                            <h2 class="fw-bold mb-0"
                                style="color: #76545c;">

                                Sistema

                            </h2>

                        </div>

                        <div class="d-flex align-items-center justify-content-center"
                             style="
                                width: 58px;
                                height: 58px;
                                border-radius: 16px;
                                background-color: #ffe4eb;
                                color: #e99aaa;
                             ">

                            <i class="fa-solid fa-gear fa-2x"></i>

                        </div>

                    </div>

                    <a href="#configuracoes"
                       class="btn btn-sm mt-4 px-3"
                       style="
                            background-color: #e99aaa;
                            color: white;
                            border-radius: 10px;
                       ">

                        <i class="fa-solid fa-arrow-right me-1"></i>
                        Configurar

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Produtos da loja -->
    <div class="card border-0 shadow-sm mb-4"
         style="
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #f3d6df !important;
         ">

        <div class="card-header border-0 py-3 px-4"
             style="
                background: linear-gradient(90deg, #ffe4eb, #fff0f3);
             ">

            <h4 class="mb-1 fw-bold"
                style="color: #76545c;">

                <i class="fa-solid fa-store me-2"
                   style="color: #e99aaa;">
                </i>

                Produtos da loja

            </h4>

            <small style="color: #a7838b;">

                Visualização dos produtos e imagens cadastradas.

            </small>

        </div>

        <div class="card-body p-4"
             style="background-color: #fffaf8;">

            <div class="row g-4">

                <!-- Produto 1 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card h-100 border-0 shadow-sm"
                         style="
                            border-radius: 15px;
                            overflow: hidden;
                            border: 1px solid #f3d6df !important;
                         ">

                        <img src="<?php echo e(asset('image/imagem_1.jpg')); ?>"
                             class="card-img-top"
                             alt="Produto PipLup Crochê"
                             style="
                                height: 220px;
                                object-fit: cover;
                             ">

                        <div class="card-body">

                            <h5 class="fw-bold"
                                style="color: #76545c;">

                                Produto em destaque

                            </h5>

                            <p class="mb-3"
                               style="color: #a7838b;">

                                Produto da loja

                            </p>

                            <a href="<?php echo e(url('/produto')); ?>"
                               class="btn btn-sm w-100"
                               style="
                                    background-color: #e99aaa;
                                    color: white;
                                    border-radius: 10px;
                               ">

                                Gerenciar produto

                            </a>

                        </div>

                    </div>

                </div>


                <!-- Produto 2 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card h-100 border-0 shadow-sm"
                         style="
                            border-radius: 15px;
                            overflow: hidden;
                            border: 1px solid #f3d6df !important;
                         ">

                        <img src="<?php echo e(asset('image/header1.png')); ?>"
                             class="card-img-top"
                             alt="Produto PipLup Crochê"
                             style="
                                height: 220px;
                                object-fit: cover;
                             ">

                        <div class="card-body">

                            <h5 class="fw-bold"
                                style="color: #76545c;">

                                Coleção especial

                            </h5>

                            <p class="mb-3"
                               style="color: #a7838b;">

                                Produto da loja

                            </p>

                            <a href="<?php echo e(url('/produto')); ?>"
                               class="btn btn-sm w-100"
                               style="
                                    background-color: #e99aaa;
                                    color: white;
                                    border-radius: 10px;
                               ">

                                Gerenciar produto

                            </a>

                        </div>

                    </div>

                </div>


                <!-- Produto 3 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card h-100 border-0 shadow-sm"
                         style="
                            border-radius: 15px;
                            overflow: hidden;
                            border: 1px solid #f3d6df !important;
                         ">

                        <img src="<?php echo e(asset('image/imagem_2.jpg')); ?>"
                             class="card-img-top"
                             alt="Produto PipLup Crochê"
                             style="
                                height: 220px;
                                object-fit: cover;
                             ">

                        <div class="card-body">

                            <h5 class="fw-bold"
                                style="color: #76545c;">

                                Mais vendidos

                            </h5>

                            <p class="mb-3"
                               style="color: #a7838b;">

                                Produto da loja

                            </p>

                            <a href="<?php echo e(url('/produto')); ?>"
                               class="btn btn-sm w-100"
                               style="
                                    background-color: #e99aaa;
                                    color: white;
                                    border-radius: 10px;
                               ">

                                Gerenciar produto

                            </a>

                        </div>

                    </div>

                </div>


                <!-- Produto 4 -->
                <div class="col-md-6 col-lg-3">

                    <div class="card h-100 border-0 shadow-sm"
                         style="
                            border-radius: 15px;
                            overflow: hidden;
                            border: 1px solid #f3d6df !important;
                         ">

                        <img src="<?php echo e(asset('image/imagem_3.jpg')); ?>"
                             class="card-img-top"
                             alt="Produto PipLup Crochê"
                             style="
                                height: 220px;
                                object-fit: cover;
                             ">

                        <div class="card-body">

                            <h5 class="fw-bold"
                                style="color: #76545c;">

                                Novidades

                            </h5>

                            <p class="mb-3"
                               style="color: #a7838b;">

                                Produto da loja

                            </p>

                            <a href="<?php echo e(url('/produto')); ?>"
                               class="btn btn-sm w-100"
                               style="
                                    background-color: #e99aaa;
                                    color: white;
                                    border-radius: 10px;
                               ">

                                Gerenciar produto

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Configurações -->
    <div id="configuracoes"
         class="card border-0 shadow-sm mb-4"
         style="
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #f3d6df !important;
         ">

        <div class="card-header border-0 py-3 px-4"
             style="
                background: linear-gradient(90deg, #ffe4eb, #fff0f3);
             ">

            <h4 class="mb-0 fw-bold"
                style="color: #76545c;">

                <i class="fa-solid fa-sliders me-2"
                   style="color: #e99aaa;">
                </i>

                Configurações do sistema

            </h4>

        </div>

        <div class="card-body p-4"
             style="background-color: #fffaf8;">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label fw-bold"
                           style="color: #76545c;">

                        Nome da loja

                    </label>

                    <input type="text"
                           class="form-control"
                           value="PipLup Crochê"
                           disabled
                           style="
                                background-color: #fff0f3;
                                border-color: #f3d6df;
                                color: #a7838b;
                           ">

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-bold"
                           style="color: #76545c;">

                        Usuário administrador

                    </label>

                    <input type="text"
                           class="form-control"
                           value="<?php echo e(session('usuario_login', 'admin')); ?>"
                           disabled
                           style="
                                background-color: #fff0f3;
                                border-color: #f3d6df;
                                color: #a7838b;
                           ">

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-bold"
                           style="color: #76545c;">

                        Status do sistema

                    </label>

                    <input type="text"
                           class="form-control"
                           value="Sistema ativo"
                           disabled
                           style="
                                background-color: #fff0f3;
                                border-color: #f3d6df;
                                color: #a7838b;
                           ">

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-bold"
                           style="color: #76545c;">

                        Área atual

                    </label>

                    <input type="text"
                           class="form-control"
                           value="Painel administrativo"
                           disabled
                           style="
                                background-color: #fff0f3;
                                border-color: #f3d6df;
                                color: #a7838b;
                           ">

                </div>

            </div>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>