<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteLoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.processar');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Página inicial do cliente
|--------------------------------------------------------------------------
*/

Route::get('/inicio', function () {
    if (session('usuario_logado')) {
        return redirect()->route('home');
    }

    if (session('cliente_logado')) {
        return redirect()->route('cliente.home');
    }

    return redirect()->route('login');
})->name('inicio');

Route::get('/', [ClienteLoginController::class, 'produtos'])
    ->name('cliente.home');


/*
|--------------------------------------------------------------------------
| Área administrativa
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    if (!session('usuario_logado')) {
        return redirect()->route('login');
    }

    return view('admin.dashboard');
})->name('home');

/*
|--------------------------------------------------------------------------
| Produtos
|--------------------------------------------------------------------------
*/

Route::get('/produto', [ProdutoController::class, 'index']);

Route::get('/produto/create', [ProdutoController::class, 'create']);

Route::post('/produto/store', [ProdutoController::class, 'store'])
    ->name('produto.store');

Route::get('/produto/edit/{id}', [ProdutoController::class, 'edit'])
    ->name('produto.edit');

Route::put('/produto/update/{id}', [ProdutoController::class, 'update'])
    ->name('produto.update');

Route::delete('/produto/{id}', [ProdutoController::class, 'destroy'])
    ->name('produto.destroy');

Route::post('/produto/search', [ProdutoController::class, 'search'])
    ->name('produto.search');


/*
|--------------------------------------------------------------------------
| Funcionários
|--------------------------------------------------------------------------
*/
Route::get('/funcionarios', [
    VagaController::class,
    'list',
])->name('vaga.list');

Route::get('/funcionarios/create', [
    VagaController::class,
    'form',
])->name('funcionarios.create');

Route::post('/funcionarios/store', [
    VagaController::class,
    'store',
])->name('funcionarios.store');

Route::get('/funcionarios/edit/{id}', [
    VagaController::class,
    'form',
])->name('funcionarios.edit');

Route::put('/funcionarios/update/{id}', [
    VagaController::class,
    'update',
])->name('funcionarios.update');

Route::delete('/funcionarios/{id}', [
    VagaController::class,
    'destroy',
])->name('funcionarios.destroy');

Route::post('/funcionarios/search', [
    VagaController::class,
    'search',
])->name('funcionarios.search');

/*
|--------------------------------------------------------------------------
| PEDIDOS
|--------------------------------------------------------------------------
*/


Route::get('/pedidos', [
    PedidoController::class,
    'list',
])->name('pedidos.list');

Route::get('/pedidos/create', [
    PedidoController::class,
    'form',
])->name('pedidos.create');

Route::post('/pedidos/store', [
    PedidoController::class,
    'store',
])->name('pedidos.store');

Route::get('/pedidos/edit/{id}', [
    PedidoController::class,
    'form',
])->name('pedidos.edit');

Route::put('/pedidos/update/{id}', [
    PedidoController::class,
    'update',
])->name('pedidos.update');

Route::delete('/pedidos/{id}', [
    PedidoController::class,
    'destroy',
])->name('pedidos.destroy');

Route::post('/pedidos/search', [
    PedidoController::class,
    'search',
])->name('pedidos.search');


/*
|--------------------------------------------------------------------------
| Vagas
|--------------------------------------------------------------------------
*/

Route::get('/vaga', [
    VagaController::class,
    'list',
])->name('vaga.list');

Route::get('/vaga/create', [
    VagaController::class,
    'form',
])->name('vaga.create');

Route::post('/vaga/store', [
    VagaController::class,
    'store',
])->name('vaga.store');

Route::get('/vaga/edit/{id}', [
    VagaController::class,
    'form',
])->name('vaga.edit');

Route::put('/vaga/update/{id}', [
    VagaController::class,
    'update',
])->name('vaga.update');

Route::delete('/vaga/{id}', [
    VagaController::class,
    'destroy',
])->name('vaga.destroy');

Route::post('/vaga/search', [
    VagaController::class,
    'search',
])->name('vaga.search');


/*
|--------------------------------------------------------------------------
| Área do cliente
|--------------------------------------------------------------------------
*/

Route::get('/cliente-inicio', [
    ClienteLoginController::class,
    'inicio',
])->name('cliente.inicio');

Route::post('/logout-cliente', [
    ClienteLoginController::class,
    'logout',
])->name('cliente.logout');
/*
|--------------------------------------------------------------------------
| Usuários
|--------------------------------------------------------------------------
*/

Route::get('/usuario', [
    UsuarioController::class,
    'list',
])->name('usuario.list');

Route::get('/usuario/create', [
    UsuarioController::class,
    'form',
])->name('usuario.create');

Route::post('/usuario/store', [
    UsuarioController::class,
    'store',
])->name('usuario.store');

Route::get('/usuario/edit/{id}', [
    UsuarioController::class,
    'form',
])->name('usuario.edit');

Route::put('/usuario/update/{id}', [
    UsuarioController::class,
    'update',
])->name('usuario.update');

Route::delete('/usuario/{id}', [
    UsuarioController::class,
    'destroy',
])->name('usuario.destroy');

Route::post('/usuario/search', [
    UsuarioController::class,
    'search',
])->name('usuario.search');


/*
|--------------------------------------------------------------------------
| Vagas
|--------------------------------------------------------------------------
*/

Route::get('/vaga', [
    VagaController::class,
    'list',
])->name('vaga.list');

Route::get('/vaga/create', [
    VagaController::class,
    'form',
])->name('vaga.create');

Route::post('/vaga/store', [
    VagaController::class,
    'store',
])->name('vaga.store');

Route::get('/vaga/edit/{id}', [
    VagaController::class,
    'form',
])->name('vaga.edit');

Route::put('/vaga/update/{id}', [
    VagaController::class,
    'update',
])->name('vaga.update');

Route::delete('/vaga/{id}', [
    VagaController::class,
    'destroy',
])->name('vaga.destroy');

Route::post('/vaga/search', [
    VagaController::class,
    'search',
])->name('vaga.search');


//////////////////////////
Route::get('/categoria', [
    CategoriaController::class,
    'list',
])->name('categoria.list');

Route::get('/categoria/create', [
    CategoriaController::class,
    'form',
])->name('categoria.create');

Route::post('/categoria/store', [
    CategoriaController::class,
    'store',
])->name('categoria.store');

Route::get('/categoria/edit/{id}', [
    CategoriaController::class,
    'form',
])->name('categoria.edit');

Route::put('/categoria/update/{id}', [
    CategoriaController::class,
    'update',
])->name('categoria.update');

Route::delete('/categoria/{id}', [
    CategoriaController::class,
    'destroy',
])->name('categoria.destroy');

Route::post('/categoria/search', [
    CategoriaController::class,
    'search',
])->name('categoria.search');
