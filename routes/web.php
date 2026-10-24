
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteLoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ItemCompraController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ItemVendaController;   


// --------------------------------------------------
// Autenticação
// --------------------------------------------------

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.processar');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// --------------------------------------------------
// Página inicial
// --------------------------------------------------

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


// --------------------------------------------------
// Área administrativa
// --------------------------------------------------

Route::get('/admin', function () {
    if (!session('usuario_logado')) {
        return redirect()->route('login');
    }

    return view('admin.dashboard');
})->name('home');


// --------------------------------------------------
// Produtos
// --------------------------------------------------

Route::get('/produto', [ProdutoController::class, 'index'])
    ->name('produto.list');

Route::get('/produto/create', [ProdutoController::class, 'create'])
    ->name('produto.create');

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


// --------------------------------------------------
// Funcionários
// --------------------------------------------------

Route::get('/funcionarios', [VagaController::class, 'list'])
    ->name('funcionarios.list');

Route::get('/funcionarios/create', [VagaController::class, 'form'])
    ->name('funcionarios.create');

Route::post('/funcionarios/store', [VagaController::class, 'store'])
    ->name('funcionarios.store');

Route::get('/funcionarios/edit/{id}', [VagaController::class, 'form'])
    ->name('funcionarios.edit');

Route::put('/funcionarios/update/{id}', [VagaController::class, 'update'])
    ->name('funcionarios.update');

Route::delete('/funcionarios/{id}', [VagaController::class, 'destroy'])
    ->name('funcionarios.destroy');

Route::post('/funcionarios/search', [VagaController::class, 'search'])
    ->name('funcionarios.search');


// --------------------------------------------------
// Vagas
// --------------------------------------------------

Route::get('/vaga', [VagaController::class, 'list'])
    ->name('vaga.list');

Route::get('/vaga/create', [VagaController::class, 'form'])
    ->name('vaga.create');

Route::post('/vaga/store', [VagaController::class, 'store'])
    ->name('vaga.store');

Route::get('/vaga/edit/{id}', [VagaController::class, 'form'])
    ->name('vaga.edit');

Route::put('/vaga/update/{id}', [VagaController::class, 'update'])
    ->name('vaga.update');

Route::delete('/vaga/{id}', [VagaController::class, 'destroy'])
    ->name('vaga.destroy');

Route::post('/vaga/search', [VagaController::class, 'search'])
    ->name('vaga.search');


// --------------------------------------------------
// Usuários
// --------------------------------------------------

Route::get('/usuario', [UsuarioController::class, 'index'])
    ->name('usuario.list');

Route::get('/usuario/create', [UsuarioController::class, 'form'])
    ->name('usuario.create');

Route::post('/usuario/store', [UsuarioController::class, 'store'])
    ->name('usuario.store');

Route::get('/usuario/edit/{id}', [UsuarioController::class, 'form'])
    ->name('usuario.edit');

Route::put('/usuario/update/{id}', [UsuarioController::class, 'update'])
    ->name('usuario.update');

Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])
    ->name('usuario.destroy');

Route::post('/usuario/search', [UsuarioController::class, 'search'])
    ->name('usuario.search');


// --------------------------------------------------
// Categorias
// --------------------------------------------------

Route::get('/categoria', [CategoriaController::class, 'list'])
    ->name('categoria.list');

Route::get('/categoria/create', [CategoriaController::class, 'form'])
    ->name('categoria.create');

Route::post('/categoria/store', [CategoriaController::class, 'store'])
    ->name('categoria.store');

Route::get('/categoria/edit/{id}', [CategoriaController::class, 'form'])
    ->name('categoria.edit');

Route::put('/categoria/update/{id}', [CategoriaController::class, 'update'])
    ->name('categoria.update');

Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])
    ->name('categoria.destroy');

Route::post('/categoria/search', [CategoriaController::class, 'search'])
    ->name('categoria.search');


// --------------------------------------------------
// Vendas
// --------------------------------------------------

Route::get('/vendas', [VendaController::class, 'index'])
    ->name('vendas.index');

Route::get('/vendas/create', [VendaController::class, 'create'])
    ->name('vendas.create');

Route::post('/vendas', [VendaController::class, 'store'])
    ->name('vendas.store');

Route::post('/vendas/search', [VendaController::class, 'search'])
    ->name('vendas.search');

Route::get('/vendas/{venda}/edit', [VendaController::class, 'edit'])
    ->name('vendas.edit');

Route::put('/vendas/{venda}', [VendaController::class, 'update'])
    ->name('vendas.update');

Route::delete('/vendas/{venda}', [VendaController::class, 'destroy'])
    ->name('vendas.destroy');


Route::get('/vendas/relatorio', [
    VendaController::class,
    'report'
])->name('vendas.report');

Route::get(
    '/vendas/produtosMaisVendidosChart',
    [VendaController::class, 'chartProdutosMaisVendidos']
)->name('vendas.produtosMaisVendidosChart');
// --------------------------------------------------
// Itens do venda
// --------------------------------------------------

Route::get('/item_venda', [ItemVendaController::class, 'index'])
    ->name('item_venda.list');

Route::get('/item_venda/create', [ItemVendaController::class, 'create'])
    ->name('item_venda.create');

Route::post('/item_venda', [ItemVendaController::class, 'store'])
    ->name('item_venda.store');

Route::post('/item_venda/search', [ItemVendaController::class, 'search'])
    ->name('item_venda.search');

Route::get('/item_venda/{id}/edit', [ItemVendaController::class, 'edit'])
    ->name('item_venda.edit');

Route::put('/item_venda/{id}', [ItemVendaController::class, 'update'])
    ->name('item_venda.update');

Route::delete('/item_venda/{id}', [ItemVendaController::class, 'destroy'])
    ->name('item_venda.destroy');


// --------------------------------------------------
// Área do cliente
// --------------------------------------------------

Route::get('/cliente-inicio', [ClienteLoginController::class, 'inicio'])
    ->name('cliente.inicio');

Route::post('/logout-cliente', [ClienteLoginController::class, 'logout'])
    ->name('cliente.logout');

    //reatorio


// --------------------------------------------------
// Compras
// --------------------------------------------------

Route::get('/compras', [CompraController::class, 'index'])
    ->name('compras.index');

Route::get('/compras/create', [CompraController::class, 'create'])
    ->name('compras.create');

Route::post('/compras', [CompraController::class, 'store'])
    ->name('compras.store');

Route::post('/compras/search', [CompraController::class, 'search'])
    ->name('compras.search');

Route::get('/compras/{compra}/edit', [CompraController::class, 'edit'])
    ->name('compras.edit');

Route::put('/compras/{compra}', [CompraController::class, 'update'])
    ->name('compras.update');

Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])
    ->name('compras.destroy');


Route::get('/compras/relatorio', [ CompraController::class,'report'
])->name('compras.report');

Route::get('/compras/ValorGastoComprasChart.blade',
    [CompraController::class, 'ValorGastoComprasChart']
)->name('compras.ValorGastoComprasChart');
// --------------------------------------------------
// Itens do venda
// --------------------------------------------------

Route::get('/item_compra', [ItemCompraController::class, 'index'])
    ->name('item_compra.list');

Route::get('/item_compra/create', [ItemCompraController::class, 'create'])
    ->name('item_compra.create');

Route::post('/item_compra', [ItemCompraController::class, 'store'])
    ->name('item_compra.store');

Route::post('/item_compra/search', [ItemCompraController::class, 'search'])
    ->name('item_compra.search');

Route::get('/item_compra/{id}/edit', [ItemCompraController::class, 'edit'])
    ->name('item_compra.edit');

Route::put('/item_compra/{id}', [ItemCompraController::class, 'update'])
    ->name('item_compra.update');

Route::delete('/item_compra/{id}', [ItemCompraController::class, 'destroy'])
    ->name('item_compra.destroy');


    

// --------------------------------------------------
// Compras
// --------------------------------------------------

Route::get('/materiais', [MaterialController::class, 'index'])
    ->name('materiais.index');

Route::get('/materiais/create', [MaterialController::class, 'create'])
    ->name('materiais.create');

Route::post('/materiais', [MaterialController::class, 'store'])
    ->name('materiais.store');

Route::post('/materiais/search', [MaterialController::class, 'search'])
    ->name('materiais.search');

Route::get('/materiais/{materiais}/edit', [MaterialController::class, 'edit'])
    ->name('materiais.edit');

Route::put('/materiais/{materiais}', [MaterialController::class, 'update'])
    ->name('materiais.update');

Route::delete('/materiais/{materiais}', [MaterialController::class, 'destroy'])
    ->name('materiais.destroy');