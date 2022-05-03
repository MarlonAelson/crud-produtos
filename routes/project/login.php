
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::redirect('/', '/login');

Route::get('/login',  [ LoginController::class, 'login' ])->name('login');
Route::post('/login', [ LoginController::class, 'autenticarUsuario' ])->name('autenticarUsuario');
Route::post('/logout', [ LoginController::class, 'logout' ])->name('logout');

//Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});