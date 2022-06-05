<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::redirect('/produtos', '/produtos/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: produtos.index)
Route::middleware(['auth'])->group(function () {
    
    Route::name('produtos.')->group(function(){
        Route::any('/produtos/listagem' , [ ProdutoController::class, 'search' ])
        ->middleware(['permission:produto_consultar'])->name('index');
        Route::post('/produtos/pesquisar' , [ ProdutoController::class, 'search' ])
        ->middleware(['permission:produto_consultar'])->name('search');
        Route::get('/produtos/detalhar/{id}' , [ ProdutoController::class, 'show' ])
        ->middleware(['permission:produto_detalhar'])->name('show');
        Route::get('/produtos/cadastro' , [ ProdutoController::class, 'create'])
        ->middleware(['permission:produto_cadastrar'])->name('create');
        Route::post('/produtos/salvar-cadastro'  , [ ProdutoController::class, 'store' ])
        ->middleware(['permission:produto_cadastrar'])->name('store');
        Route::get('/produtos/alteracao/{id}', [ ProdutoController::class, 'edit'])
        ->middleware(['permission:produto_alterar'])->name('edit');
        Route::put('/produtos/salvar-alteracao/{id}'  , [ ProdutoController::class, 'update'])
        ->middleware(['permission:produto_alterar'])->name('update');
        Route::get('/produtos/excluir/{id}'  , [ ProdutoController::class, 'destroy'])
        ->middleware(['permission:produto_excluir'])->name('destroy');
        Route::get('/produtos/inativar-ativar/{id}' , [ ProdutoController::class, 'inactiveOrActive' ])
        ->middleware(['permission:produto_inativar_ativar'])->name('inactiveOrActive');
        Route::get('/produtos/clonar/{id}' , [ ProdutoController::class, 'replicate' ])
        ->middleware(['permission:produto_cadastrar'])->name('replicate');
        Route::get('/produtos/pdf' , [ ProdutoController::class, 'pdf' ])
        ->middleware(['permission:produto_pdf'])->name('pdf');
    });

});