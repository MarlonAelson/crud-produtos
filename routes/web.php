<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
};

/* Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()" 
** do arquivo "App\Providers\RouteServiceProvider.php" para certi
** ficar que todo parametro id passado na url serão números.
*/

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::redirect('/', '/login');

Route::get('/login',  [ LoginController::class, 'login' ])->name('login');
Route::post('/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');
Route::get('/logout', [ LoginController::class, 'logout' ])->name('logout');

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
