<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemController;

Route::redirect('/{identification}/ordens', '/{identification}/ordens/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
Route::middleware(['auth'])->group(function () {

    Route::name('ordens.')
        ->group(function(){
            Route::get('/{identification}/ordens/listagem' , [ OrdemController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/{identification}/ordens/detalhar/{id}' , [ OrdemController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/{identification}/ordens/cadastro' , [ OrdemController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/{identification}/ordens/salvar-cadastro'  , [ OrdemController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/{identification}/ordens/alteracao/{id}', [ OrdemController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/{identification}/ordens/salvar-alteracao/{id}'  , [ OrdemController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/{identification}/ordens/excluir/{id}'  , [ OrdemController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/{identification}/ordens/inativar-ativar/{id}' , [ OrdemController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/{identification}/ordens/clonar/{id}' , [ OrdemController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/{identification}/ordens/pdf/{id?}' , [ OrdemController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/{identification}/ordens/email' , [ OrdemController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/{identification}/ordens/excel' , [ OrdemController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });

});