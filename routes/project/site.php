<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/404' , [ SiteController::class, 'error404' ])->name('404');
Route::get('/' ,    [ SiteController::class, 'index' ])->name('index');    