<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginControlle
};

Route::get('{type_app_nav}/{identification}/teste', function(){
    return 'login';
});

##### USADOS PARA TESTES.... APAGAR DEPOIS
Route::get('/loginn', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');//usado para teste json
Route::get('/testee', [ PessoaController::class, 'pdf' ]);//usado para teste json
