<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - PipLup Crochê</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body
    class="d-flex align-items-center justify-content-center min-vh-100"
    style="background-color: #fff6ed;"
>
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h2>PipLup Crochê</h2>
            <p class="text-muted">Entre para acessar sua área</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.processar') }}">
            @csrf

            <div class="mb-3">
                <label for="login" class="form-label">
                    Login
                </label>

                <input
                    type="text"
                    name="login"
                    id="login"
                    class="form-control"
                    value="{{ old('login') }}"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">
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

            <button type="submit" class="btn btn-primary w-100">
                Entrar
            </button>
        </form>
    </div>
</body>
</html>