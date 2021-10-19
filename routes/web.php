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
        Route::get('/categoria/index', [ CategoriaController::class, 'index' ])->middleware(['permission:categoria_consultar']);
        Route::get('/categoria/show', [ CategoriaController::class, 'show'])->middleware(['permission:categoria_detalhar']);
        Route::get('/categoria/create', [ CategoriaController::class, 'create' ])->middleware(['permission:categoria_cadastrar']);
        Route::post('/categoria/store', [ CategoriaController::class, 'store' ])->middleware(['permission:categoria_cadastrar']);
        Route::put('/categoria/edit', [ CategoriaController::class, 'edit'])->middleware(['permission:categoria_editar']);
        Route::put('/categoria/update', [ CategoriaController::class, 'update'])->middleware(['permission:categoria_editar']);
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
