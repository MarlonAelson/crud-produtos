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
    Route::name('categorias.')->group(function(){//utilizado para definir prefixos nos nomes as rotas (EX: categorias.index)
        Route::get('/categorias-list', [ CategoriaController::class, 'index' ])->middleware(['permission:categoria_consultar'])->name('list');
        Route::get('/categorias-form', [ CategoriaController::class, 'form'])->middleware(['permission:categoria_cadastrar'])->name('form');
        Route::post('/categorias-store', [ CategoriaController::class, 'store' ])->middleware(['permission:categoria_cadastrar'])->name('store');
        Route::put('/categorias-edit', [ CategoriaController::class, 'edit'])->middleware(['permission:categoria_editar'])->name('edit');
        Route::put('/categorias-update', [ CategoriaController::class, 'update'])->middleware(['permission:categoria_editar'])->name('update');
    });

    Route::name('categorias.')->group(function(){
        Route::get('/categorias/listagem' , [ CategoriaController::class, 'index' ])->middleware(['permission:categoria_consultar'])->name('index');
        Route::get('/categorias/detalhar' , [ CategoriaController::class, 'show' ])->middleware(['permission:categoria_detalhar'])->name('show');
        Route::get('/categorias/cadastro' , [ CategoriaController::class, 'create'])->middleware(['permission:categoria_cadastrar'])->name('create');
        Route::post('/categorias/salvar'  , [ CategoriaController::class, 'store' ])->middleware(['permission:categoria_cadastrar'])->name('store');
        Route::get('/categorias/alteracao', [ CategoriaController::class, 'edit'])->middleware(['permission:categoria_alterar'])->name('edit');
        Route::put('/categorias/alterar'  , [ CategoriaController::class, 'update'])->middleware(['permission:categoria_alterar'])->name('update');
        Route::put('/categorias/excluir'  , [ CategoriaController::class, 'destroy'])->middleware(['permission:categoria_excluir'])->name('destroy');
        Route::get('/categorias/inativar-ativar' , [ CategoriaController::class, 'inactiveOrActive' ])->middleware(['permission:categoria_consultar'])->name('inactiveOrActive');
    });

    Route::name('usuarios.')->group(function(){
        Route::get('/usuarios-list',           [ PessoaController::class,'index' ])->middleware(['permission:usuario_consultar'])->name('list');
        Route::get('/usuarios-form',           [ PessoaController::class,'form' ])->middleware(['permission:usuario_cadastrar'])->name('form');
        Route::post('/usuarios-store',         [ PessoaController::class,'store' ])->middleware(['permission:usuario_cadastrar'])->name('store');
        Route::get('/usuarios-edit/{id}',      [ PessoaController::class,'edit' ])->middleware(['permission:usuario_editar'])->name('edit');
        Route::put('/usuarios-update/{id}',    [ PessoaController::class,'update' ])->middleware(['permission:usuario_editar'])->name('update');
    });
});


/*Route::prefix('/{domain}/cadastros-basicos')->group(function(){ //prefixo da roda (EX: localhost:8000/"cadastros-basicos")
    //Route::namespace('Cadastros-Basicos')->group(function(){}) //utilizado quando existe separação por pastas dentro da pasta controllers (EX: Controllers/Cadastros-Basicos)
    
    Route::name('categorias.')->group(function(){//utilizado para definir prefixos nos nomes as rotas (EX: categorias.index)
        Route::post('/categoria', 'MarcaProdutoController@index')->middleware(['can:index,App\Models\MarcaProduto']);
        Route::post('/categoria/store', 'MarcaProdutoController@store')->middleware(['can:store,App\Models\MarcaProduto']);
        Route::get('/categoria/show/{id}', 'MarcaProdutoController@show')->middleware(['can:show,App\Models\MarcaProduto']);
        Route::put('/categoria/update/{id}', 'MarcaProdutoController@update')->middleware(['can:update,App\Models\MarcaProduto']);
        Route::get('/categoria/list', 'MarcaProdutoController@list')->middleware(['can:index,App\Models\MarcaProduto']);
        Route::get('/categoria/ativo/{id}', 'MarcaProdutoController@setAtivo')->middleware(['can:setAtivo,App\Models\MarcaProduto']);
    });
});*/

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
