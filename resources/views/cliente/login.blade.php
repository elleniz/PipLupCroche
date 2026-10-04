@extends('cliente.main')

@section('titulo', 'Login do Cliente')

@section('conteudo')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div
                class="card shadow-sm border-0"
                style="
                    background-color: #fffaf8;
                    border-radius: 20px;
                "
            >

                <div class="card-body p-4">

                    <h2
                        class="text-center mb-4"
                        style="color: #76545c;"
                    >
                        Login do Cliente
                    </h2>

                    @if (session('error'))

                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                    @endif

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('cliente.login.processar') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="mb-3">

                            <label
                                for="usuario"
                                class="form-label"
                            >
                                Usuário
                            </label>

                            <input
                                type="text"
                                name="usuario"
                                id="usuario"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="senha"
                                class="form-label"
                            >
                                Senha
                            </label>

                            <input
                                type="password"
                                name="senha"
                                id="senha"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn w-100"
                            style="
                                background-color: #ed8eaa;
                                color: white;
                                border-radius: 20px;
                            "
                        >
                            Entrar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection