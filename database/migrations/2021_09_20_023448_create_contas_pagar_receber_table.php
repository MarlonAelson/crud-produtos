<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasPagarReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_pagar_receber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('pessoas');
            $table->unsignedBigInteger('pessoa_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('tipo_duplicata')->nullable();
            $table->string('documento')->nullable();
            $table->unsignedBigInteger('forma_cobranca_id')->nullable();
            $table->foreign('forma_cobranca_id')->references('id')->on('formas_pagamento');
            $table->unsignedBigInteger('condicao_pagamento_id')->nullable();
            $table->foreign('condicao_pagamento_id')->references('id')->on('condicoes_pagamento');
            $table->integer('numero_parcela')->nullable();
            $table->integer('quantidade_parcela')->nullable();
            $table->string('situacao', 45)->nullable();
            $table->decimal('valor_duplicata', 18,2)->nullable();
            $table->decimal('valor_juros', 18,2)->nullable();
            $table->decimal('percentual_juros', 18,2)->nullable();
            $table->decimal('valor_multa', 18,2)->nullable();
            $table->decimal('percentual_multa', 18,2)->nullable();
            $table->decimal('valor_acrescimo', 18,2)->nullable();
            $table->decimal('percentual_acrescimo', 18,2)->nullable();
            $table->decimal('valor_desconto', 18,2)->nullable();
            $table->decimal('percentual_desconto', 3,2)->nullable();
            $table->string('tipo_desconto')->nullable();//no valor liquido ou no valor total da duplicata
            $table->decimal('valor_total_duplicata', 18,2)->nullable();
            $table->decimal('valor_total_duplicata_original', 18,2)->nullable();
            $table->date('data_vencimento')->nullable();
            $table->datetime('data_pagamento')->nullable();
            $table->datetime('data_baixa')->nullable();
            $table->decimal('valor_pagamento', 18,2)->nullable();            
            $table->unsignedBigInteger('forma_pagamento_id')->nullable();
            $table->foreign('forma_pagamento_id')->references('id')->on('formas_pagamento');
            $table->unsignedBigInteger('usuario_pagamento_id')->nullable();
            $table->foreign('usuario_pagamento_id')->references('id')->on('pessoas');
            $table->unsignedBigInteger('conta_bancaria_id')->nullable();
            //$table->foreign('conta_bancaria_id')->references('id')->on('contas_bancarias');
            $table->unsignedBigInteger('plano_conta_id')->nullable();
            //$table->foreign('plano_conta_id')->references('id')->on('planos_conta');
            $table->string('houve_reativacao',10)->nullable();
            $table->datetime('data_reativacao')->nullable();
            $table->unsignedBigInteger('usuario_reativacao_id')->nullable();
            $table->foreign('usuario_reativacao_id')->references('id')->on('pessoas');
            $table->datetime('data_cancelamento')->nullable();
            $table->unsignedBigInteger('usuario_cancelamento_id')->nullable();
            $table->foreign('usuario_cancelamento_id')->references('id')->on('pessoas');
            $table->string('justificativa_cancelamento')->nullable();
            $table->string('observacoes')->nullable();
            $table->date('data_emissao')->nullable();
            $table->unsignedBigInteger('usuario_cadastro_id')->nullable();
            $table->foreign('usuario_cadastro_id')->references('id')->on('pessoas');
            $table->unsignedBigInteger('usuario_alteracao_id')->nullable();
            $table->foreign('usuario_alteracao_id')->references('id')->on('pessoas');
            $table->string('historico_de_acoes_duplicata')->nullable();
            //$table->datetime('data_processamento_arquivo')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_pagar_receber');
    }
}
