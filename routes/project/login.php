
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login',  [ LoginController::class, 'login' ])->name('login')->middleware(['connection_tenant']);
Route::post('/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario')->middleware(['connection_tenant']);
Route::get('/logout', [ LoginController::class, 'logout' ])->name('logout');

