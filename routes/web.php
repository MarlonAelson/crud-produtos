<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    PessoaController,
    TenantController,
    CategoriaController,
};

/* Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()" 
** do arquivo "App\Providers\RouteServiceProvider.php" para certi
** ficar que todo parametro id passado na url serão números.
*/

/*
** "name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
*/

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/tenant/store', [ TenantController::class, 'store'] )->name('tenant.store');
Route::redirect('/', '/login');

Route::get('{domain}/teste', function(){
    return 'login';
});

Route::get('/login',  [ LoginController::class, 'login' ])->name('login');
Route::post('/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');
Route::get('/logout', [ LoginController::class, 'logout' ])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::name('categorias.')->group(function(){
        Route::get('/categorias/listagem' , [ CategoriaController::class, 'index' ])->middleware(['permission:categoria_consultar'])->name('index');
        Route::get('/categorias/detalhar' , [ CategoriaController::class, 'show' ])->middleware(['permission:categoria_detalhar'])->name('show');
        Route::get('/categorias/cadastro' , [ CategoriaController::class, 'create'])->middleware(['permission:categoria_cadastrar'])->name('create');
        Route::post('/categorias/salvar'  , [ CategoriaController::class, 'store' ])->middleware(['permission:categoria_cadastrar'])->name('store');
        Route::get('/categorias/alteracao', [ CategoriaController::class, 'edit'])->middleware(['permission:categoria_alterar'])->name('edit');
        Route::put('/categorias/alterar'  , [ CategoriaController::class, 'update'])->middleware(['permission:categoria_alterar'])->name('update');
        Route::get('/categorias/excluir/{id}'  , [ CategoriaController::class, 'destroy'])->middleware(['permission:categoria_excluir'])->name('destroy');
        Route::get('/categorias/inativar-ativar' , [ CategoriaController::class, 'inactiveOrActive' ])->middleware(['permission:categoria_consultar'])->name('inactiveOrActive');
    });
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
