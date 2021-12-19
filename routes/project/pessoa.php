<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;

Route::redirect('/pessoas', '/pessoas/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
Route::middleware(['auth'])->group(function () {

    Route::name('pessoas.')
        ->group(function(){
            /*Route::match(['get', 'post'], '/pessoas/listagem' , [ PessoaController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');*/
            Route::match(['get', 'post'], '/pessoas/listagem' , [ PessoaController::class, 'search' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/pessoas/detalhar/{id}' , [ PessoaController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/pessoas/cadastro' , [ PessoaController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/pessoas/salvar-cadastro'  , [ PessoaController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/pessoas/alteracao/{id}', [ PessoaController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/pessoas/salvar-alteracao/{id}'  , [ PessoaController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/pessoas/excluir/{id}'  , [ PessoaController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/pessoas/inativar-ativar/{id}' , [ PessoaController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/pessoas/clonar/{id}' , [ PessoaController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/pessoas/pdf/{id?}' , [ PessoaController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/pessoas/email' , [ PessoaController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/pessoas/excel' , [ PessoaController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });

});