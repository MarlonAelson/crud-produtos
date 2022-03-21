
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/{domain}/login',  [ LoginController::class, 'login' ])->name('login');
Route::post('/{domain}/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');
Route::get('/{domain}/logout', [ LoginController::class, 'logout' ])->name('logout');

Route::post('/verify-identification', [ LoginController::class, 'verifyIdentification' ])->name('verifyIdentification');

