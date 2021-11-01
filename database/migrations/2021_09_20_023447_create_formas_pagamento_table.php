<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormasPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formas_pagamento', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->string('sigla', 5);
            $table->char('situacao', 1)->nullable();
            $table->char('aparece_para_docs_proprios', 1)->nullable();
            $table->char('aparece_para_docs_terceiros', 1)->nullable();
            $table->char('permite_troco', 1)->nullable();
            $table->char('considera_no_debito_em_aberto', 1)->nullable();
            $table->decimal('juros', 10,2)->nullable();
            $table->decimal('multa', 10,2)->nullable();
            $table->decimal('comissao', 10,2)->nullable();
            $table->char('ativo', 1);
            $table->unsignedBigInteger('administradora_cartao_id')->nullable();
            $table->foreign('administradora_cartao_id')->references('id')->on('pessoas');
            $table->string('tipo_integracao_cartao', 45)->nullable();
            $table->string('bandeira_cartao', 45)->nullable();
            $table->unsignedBigInteger('usuario_cadastro_id');
            $table->foreign('usuario_cadastro_id')->references('id')->on('pessoas');
            $table->unsignedBigInteger('usuario_alteracao_id');
            $table->foreign('usuario_alteracao_id')->references('id')->on('pessoas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formas_pagamento');
    }
}
