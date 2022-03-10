<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/' ,    [ SiteController::class, 'index' ])->name('index')->middleware(['verify_tenant_permited']);
Route::post('/verifyTenant' ,   [ SiteController::class, 'verifyTenant' ])->name('verifyTenant')->middleware(['verify_tenant_permited', 'connection_tenant']);
Route::get('/404' , [ SiteController::class, 'error404' ])->name('404');