<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;

Route::redirect('/{identification}/pessoas', '/{identification}/pessoas/listagem');
//"name" do "group" é utilizado para definir prefixos nos nomes as rotas (ex: categorias.index)
Route::middleware(['auth'])->group(function () {

    Route::name('pessoas.')
        ->group(function(){
            /*Route::match(['get', 'post'], '/{identification}/pessoas/listagem' , [ PessoaController::class, 'index' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');*/
            Route::match(['get', 'post'], '/{identification}/pessoas/listagem' , [ PessoaController::class, 'search' ])
            ->middleware(['permission:pessoa_consultar'])->name('index');
            Route::get('/{identification}/pessoas/detalhar/{id}' , [ PessoaController::class, 'show' ])
            ->middleware(['permission:pessoa_detalhar'])->name('show');
            Route::get('/{identification}/pessoas/cadastro' , [ PessoaController::class, 'create'])
            ->middleware(['permission:pessoa_cadastrar'])->name('create');
            Route::post('/{identification}/pessoas/salvar-cadastro'  , [ PessoaController::class, 'store' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('store');
            Route::get('/{identification}/pessoas/alteracao/{id}', [ PessoaController::class, 'edit'])
            ->middleware(['permission:pessoa_alterar'])->name('edit');
            Route::put('/{identification}/pessoas/salvar-alteracao/{id}'  , [ PessoaController::class, 'update'])
            ->middleware(['permission:pessoa_alterar'])->name('update');
            Route::get('/{identification}/pessoas/excluir/{id}'  , [ PessoaController::class, 'destroy'])
            ->middleware(['permission:pessoa_excluir'])->name('destroy');
            Route::get('/{identification}/pessoas/inativar-ativar/{id}' , [ PessoaController::class, 'inactiveOrActive' ])
            ->middleware(['permission:pessoa_inativar_ativar'])->name('inactiveOrActive');
            Route::get('/{identification}/pessoas/clonar/{id}' , [ PessoaController::class, 'replicate' ])
            ->middleware(['permission:pessoa_cadastrar'])->name('replicate');
            Route::get('/{identification}/pessoas/pdf/{id?}' , [ PessoaController::class, 'pdf' ])
            ->middleware(['permission:pessoa_pdf'])->name('pdf');
            Route::get('/{identification}/pessoas/email' , [ PessoaController::class, 'email' ])
            ->middleware(['permission:pessoa_email'])->name('email');
            Route::get('/{identification}/pessoas/excel' , [ PessoaController::class, 'excel' ])
            ->middleware(['permission:pessoa_excel'])->name('excel');
    });

});