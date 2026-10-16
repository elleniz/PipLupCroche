<nav class="navbar navbar-expand border-bottom px-3"
     style="background-color: #fff6ed;">

    <div class="container-fluid d-flex align-items-center justify-content-center">

        <ul class="navbar-nav d-flex flex-row align-items-center gap-5 m-0">

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ route('inicio') }}">
                    INÍCIO
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ route('usuario.list') }}">
                    USUÁRIOS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ url('produto') }}">
                    PRODUTOS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ url('vaga') }}">
                    VAGAS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ url('categoria') }}">
                    CATEGORIAS
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   style="color: #55003E; font-size: 14px;"
                   href="{{ route('pedidos.list') }}">
                    PEDIDOS
                </a>
            </li>

        </ul>

    </div>

</nav>
