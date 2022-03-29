<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;

Route::get('/{identification}/tenant/store', [ TenantController::class, 'store' ] )->name('tenant.store');
