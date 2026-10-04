<!-- Topbar Rosa -->
<div class="text-center py-2"
     style="
        background: linear-gradient(90deg, #e7b9bd, #edc6cc, #e7b9bd);
        color: #fff;
        font-size: 14px;
        letter-spacing: 0.3px;
     ">

    ✨ Bem-vindo ao Site PipLup Crochê ✨

</div>

<?php
    $isAdmin = session('usuario_logado') === true;
    $isCliente = session('cliente_logado') === true;
?>

<!-- Header Principal -->
<header class="py-3"
        style="
            background-color: #fffaf6;
            border-bottom: 1px solid #f1dfe2;
        ">

    <div class="container-fluid px-4">

        <div class="d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <div style="width: 220px;">

                <a href="<?php echo e(route('inicio')); ?>"
                   style="text-decoration: none;">

                    <img
                        src="<?php echo e(asset('image/Logo.jpeg')); ?>"
                        alt="Logo PipLup Crochê"
                        style="
                            width: 180px;
                            max-width: 100%;
                            height: auto;
                        ">

                </a>

            </div>

            <!-- Nome da área -->
            <div class="text-center d-none d-md-block">

                <h5 style="
                    color: #6d3f36;
                    font-family: Georgia, serif;
                    font-weight: bold;
                    margin: 0;
                ">

                    <?php if($isAdmin): ?>
                        Painel Administrativo
                    <?php elseif($isCliente): ?>
                        PipLup Crochê
                    <?php else: ?>
                        PipLup Crochê
                    <?php endif; ?>

                </h5>

                <small style="
                    color: #a7838b;
                    font-size: 12px;
                ">

                    <?php if($isAdmin): ?>
                        Área administrativa
                    <?php elseif($isCliente): ?>
                        Área do cliente
                    <?php else: ?>
                        Bem-vindo
                    <?php endif; ?>

                </small>

            </div>

            <!-- Conta -->
            <div style="
                width: 220px;
                display: flex;
                justify-content: flex-end;
            ">

                <?php if($isAdmin || $isCliente): ?>

                    <?php
                        if ($isAdmin) {
                            $nomeUsuario = session('usuario_login', 'Admin');
                            $tipoConta = 'Conta administrativa';
                            $textoMenu = 'Painel administrativo';
                            $rotaMenu = route('home');
                            $rotaLogout = route('logout');
                        } else {
                            $nomeUsuario = session('cliente_nome', 'Cliente');
                            $tipoConta = 'Conta de cliente';
                            $textoMenu = 'Página inicial';
                            $rotaMenu = route('cliente.home');
                            $rotaLogout = route('cliente.logout');
                        }
                    ?>

                    <div class="dropdown">

                        <button
                            class="btn dropdown-toggle d-flex align-items-center gap-2"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="
                                background-color: #ffe4eb;
                                color: #76545c;
                                border: 1px solid #f3d6df;
                                border-radius: 25px;
                                padding: 9px 16px;
                                font-size: 13px;
                            ">

                            <i class="fa-solid fa-user"></i>

                            <span>
                                <?php echo e($nomeUsuario); ?>

                            </span>

                        </button>

                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            style="
                                border: 1px solid #f3d6df;
                                border-radius: 12px;
                                padding: 8px;
                                min-width: 220px;
                                background-color: #fffaf6;
                            ">

                            <li class="px-3 py-2">

                                <div style="
                                    color: #6d3f36;
                                    font-weight: bold;
                                    font-size: 14px;
                                ">

                                    <i class="fa-solid fa-user me-2"></i>

                                    <?php echo e($nomeUsuario); ?>


                                </div>

                                <small style="
                                    color: #a7838b;
                                ">

                                    <?php echo e($tipoConta); ?>


                                </small>

                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <a
                                    class="dropdown-item"
                                    href="<?php echo e($rotaMenu); ?>"
                                    style="
                                        color: #76545c;
                                        border-radius: 8px;
                                        font-size: 13px;
                                    ">

                                    <i class="fa-solid fa-house me-2"></i>

                                    <?php echo e($textoMenu); ?>


                                </a>

                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <form action="<?php echo e($rotaLogout); ?>" method="POST">

                                    <?php echo csrf_field(); ?>

                                    <button
                                        type="submit"
                                        class="dropdown-item"
                                        style="
                                            color: #c90045;
                                            border-radius: 8px;
                                            font-size: 13px;
                                        ">

                                        <i class="fa-solid fa-right-from-bracket me-2"></i>

                                        Sair

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                <?php else: ?>

                    <a
                        href="<?php echo e(route('login')); ?>"
                        class="btn"
                        style="
                            background-color: #ffe4eb;
                            color: #76545c;
                            border: 1px solid #f3d6df;
                            border-radius: 25px;
                            padding: 9px 20px;
                            font-size: 13px;
                        ">

                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        Entrar

                    </a>

                <?php endif; ?>

            </div>

        </div>

    </div>

</header>


<style>

    .dropdown-item {
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #ffeaf0 !important;
        color: #76545c !important;
        transform: translateX(2px);
    }

    .dropdown > button > div {
        transition: all 0.2s ease;
    }

    .dropdown > button:hover > div {
        background: linear-gradient(135deg, #fff5f7, #ffe5ec) !important;
        border-color: #eab7c5 !important;
        box-shadow: 0 5px 15px rgba(190, 130, 145, 0.16) !important;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {

        header .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        header img {
            width: 145px !important;
        }

        .dropdown > button > div {
            min-width: auto !important;
            padding: 8px 10px !important;
        }

        .dropdown > button > div > div:first-child {
            width: 38px !important;
            height: 38px !important;
            min-width: 38px !important;
        }

        .dropdown > button > div > div:nth-child(2) {
            display: none;
        }

    }

</style><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/header.blade.php ENDPATH**/ ?>