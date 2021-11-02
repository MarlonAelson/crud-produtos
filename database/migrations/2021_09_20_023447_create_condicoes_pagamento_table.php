<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicoesPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condicoes_pagamento', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->integer('quantidade_parcela');
            $table->integer('intervalo_dias_entre_parcela');
            $table->decimal('valor_minimo_condicao', 18,2)->nullable();
            $table->string('indicador_pagamento',45)->nullable();
            $table->char('ativo', 1);           
            $table->unsignedBigInteger('usuario_cadastro_id');
            $table->unsignedBigInteger('usuario_alteracao_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('usuario_cadastro_id')->references('id')->on('pessoas');
            $table->foreign('usuario_alteracao_id')->references('id')->on('pessoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condicoes_pagamento');
    }
}
