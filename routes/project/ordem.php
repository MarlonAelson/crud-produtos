<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemController;

Route::redirect('/ordens', '/ordens/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
Route::middleware(['auth'])->group(function () {

    Route::name('ordens.')
        ->group(function(){
            Route::get('/ordens/listagem' , [ OrdemController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/ordens/detalhar/{id}' , [ OrdemController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/ordens/cadastro' , [ OrdemController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/ordens/salvar-cadastro'  , [ OrdemController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/ordens/alteracao/{id}', [ OrdemController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/ordens/salvar-alteracao/{id}'  , [ OrdemController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/ordens/excluir/{id}'  , [ OrdemController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/ordens/inativar-ativar/{id}' , [ OrdemController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/ordens/clonar/{id}' , [ OrdemController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/ordens/pdf/{id?}' , [ OrdemController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/ordens/email' , [ OrdemController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/ordens/excel' , [ OrdemController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });

});