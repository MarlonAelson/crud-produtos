<?php

use Illuminate\Support\Facades\Route;

/* Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()"
** do arquivo "App\Providers\RouteServiceProvider.php" para certi
** ficar que todo parametro id passado na url serão números.
*/

CONST PROJECT_ROUTES_FOLDER = 'project';

require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/categoria.php";
require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/pessoa.php";
require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/ordem.php";
require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/tenant.php";
require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/login.php";
require __DIR__."/" . PROJECT_ROUTES_FOLDER . "/testes.php";

//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
