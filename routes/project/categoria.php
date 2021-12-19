<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::redirect('/categorias', '/categorias/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
Route::middleware(['auth'])->group(function () {
    
    Route::name('categorias.')->group(function(){
        Route::get('/categorias/listagem' , [ CategoriaController::class, 'index' ])
        ->middleware(['permission:categoria_consultar'])->name('index');
        Route::get('/categorias/detalhar/{id}' , [ CategoriaController::class, 'show' ])
        ->middleware(['permission:categoria_detalhar'])->name('show');
        Route::get('/categorias/cadastro' , [ CategoriaController::class, 'create'])
        ->middleware(['permission:categoria_cadastrar'])->name('create');
        Route::post('/categorias/salvar-cadastro'  , [ CategoriaController::class, 'store' ])
        ->middleware(['permission:categoria_cadastrar'])->name('store');
        Route::get('/categorias/alteracao/{id}', [ CategoriaController::class, 'edit'])
        ->middleware(['permission:categoria_alterar'])->name('edit');
        Route::put('/categorias/salvar-alteracao/{id}'  , [ CategoriaController::class, 'update'])
        ->middleware(['permission:categoria_alterar'])->name('update');
        Route::get('/categorias/excluir/{id}'  , [ CategoriaController::class, 'destroy'])
        ->middleware(['permission:categoria_excluir'])->name('destroy');
        Route::get('/categorias/inativar-ativar/{id}' , [ CategoriaController::class, 'inactiveOrActive' ])
        ->middleware(['permission:categoria_inativar_ativar'])->name('inactiveOrActive');
        Route::get('/categorias/clonar/{id}' , [ CategoriaController::class, 'replicate' ])
        ->middleware(['permission:categoria_cadastrar'])->name('replicate');
        Route::get('/categorias/pdf/{id?}' , [ CategoriaController::class, 'pdf' ])
        ->middleware(['permission:categoria_cadastrar'])->name('pdf');
        Route::get('/categorias/email' , [ CategoriaController::class, 'email' ])
        ->middleware(['permission:categoria_cadastrar'])->name('email');
    });

});