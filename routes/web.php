<?php

use Illuminate\Support\Facades\Route;

/* 
** Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()"
** do arquivo "App\Providers\RouteServiceProvider.php" para certi
** ficar que todo parametro id passado na url serão números.
*/

const PROJECT_ROUTES_FOLDER = 'project';

require __DIR__ . "/" . PROJECT_ROUTES_FOLDER . "/login.php";
require __DIR__ . "/" . PROJECT_ROUTES_FOLDER . "/categoria.php";
require __DIR__ . "/" . PROJECT_ROUTES_FOLDER . "/produto.php";