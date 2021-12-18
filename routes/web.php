<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoriaController,
    LoginController,
    PessoaController,
    TenantController,
    OrdemController,
};

/* Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()"
** do arquivo "App\Providers\RouteServiceProvider.php" para certi
** ficar que todo parametro id passado na url serão números.
*/

/*
** "name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
*/
Route::get('/', function () {
    return view('site');
})->name('site');

Route::redirect('/categorias', '/categorias/listagem');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/tenant/store', [ TenantController::class, 'store'] )->name('tenant.store');

Route::get('{type_app_nav}/{identification}/teste', function(){
    return 'login';
});

Route::get('/login',  [ LoginController::class, 'login' ])->name('login');
Route::post('/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');
Route::get('/loginn', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');//usado para teste json
Route::get('/logout', [ LoginController::class, 'logout' ])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::name('categorias.')->group(function(){
        Route::get('/categorias/listagem' , [ CategoriaController::class, 'index' ])
        ->middleware(['permission:categoria_consultar'])->name('index');
        Route::get('/categorias/detalhar/{id}' , [ CategoriaController::class, 'show' ])
        ->middleware(['permission:categoria_detalhar'])->name('show');
        Route::get('/categorias/cadastro' , [ CategoriaController::class, 'create'])
        ->middleware(['permission:categoria_cadastrar'])->name('create');
        Route::post('/categorias/salvar-cadastro'  , [ CategoriaController::class, 'store' ])
        ->middleware(['permission:categoria_cadastrar'])->name('store');
        Route::get('/categorias/alteracao/{id}', [ CategoriaController::class, 'edit'])
        ->middleware(['permission:categoria_alterar'])->name('edit');
        Route::put('/categorias/salvar-alteracao/{id}'  , [ CategoriaController::class, 'update'])
        ->middleware(['permission:categoria_alterar'])->name('update');
        Route::get('/categorias/excluir/{id}'  , [ CategoriaController::class, 'destroy'])
        ->middleware(['permission:categoria_excluir'])->name('destroy');
        Route::get('/categorias/inativar-ativar/{id}' , [ CategoriaController::class, 'inactiveOrActive' ])
        ->middleware(['permission:categoria_inativar_ativar'])->name('inactiveOrActive');
        Route::get('/categorias/clonar/{id}' , [ CategoriaController::class, 'replicate' ])
        ->middleware(['permission:categoria_cadastrar'])->name('replicate');
        Route::get('/categorias/pdf/{id?}' , [ CategoriaController::class, 'pdf' ])
        ->middleware(['permission:categoria_cadastrar'])->name('pdf');
        Route::get('/categorias/email' , [ CategoriaController::class, 'email' ])
        ->middleware(['permission:categoria_cadastrar'])->name('email');
    });

    Route::name('pessoas.')
        ->group(function(){
            /*Route::match(['get', 'post'], '/pessoas/listagem' , [ PessoaController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');*/
            Route::match(['get', 'post'], '/pessoas/listagem' , [ PessoaController::class, 'search' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/pessoas/detalhar/{id}' , [ PessoaController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/pessoas/cadastro' , [ PessoaController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/pessoas/salvar-cadastro'  , [ PessoaController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/pessoas/alteracao/{id}', [ PessoaController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/pessoas/salvar-alteracao/{id}'  , [ PessoaController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/pessoas/excluir/{id}'  , [ PessoaController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/pessoas/inativar-ativar/{id}' , [ PessoaController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/pessoas/clonar/{id}' , [ PessoaController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/pessoas/pdf/{id?}' , [ PessoaController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/pessoas/email' , [ PessoaController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/pessoas/excel' , [ PessoaController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });

    Route::name('ordens.')
        ->group(function(){
            Route::get('/ordens/listagem' , [ OrdemController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/ordens/detalhar/{id}' , [ OrdemController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/ordens/cadastro' , [ OrdemController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/ordens/salvar-cadastro'  , [ OrdemController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/ordens/alteracao/{id}', [ OrdemController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/ordens/salvar-alteracao/{id}'  , [ OrdemController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/ordens/excluir/{id}'  , [ OrdemController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/ordens/inativar-ativar/{id}' , [ OrdemController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/ordens/clonar/{id}' , [ OrdemController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/ordens/pdf/{id?}' , [ OrdemController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/ordens/email' , [ OrdemController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/ordens/excel' , [ OrdemController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
