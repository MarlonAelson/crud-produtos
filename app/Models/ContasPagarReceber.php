<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContasPagarReceber extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contas_pagar_receber';
    protected $guarded = ['id'];
    //necessário para o softdelete
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'empresa_id',
        'pessoa_id',
        'tipo_duplicata',
        'documento',
        'forma_cobranca_id',
        'condicao_pagamento_id',
        'numero_parcela',
        'quantidade_parcela',
        'situacao',
        'valor_duplicata', 
        'valor_juros', 
        'percentual_juros', 
        'valor_multa', 
        'percentual_multa', 
        'valor_acrescimo', 
        'percentual_acrescimo', 
        'valor_desconto', 
        'percentual_desconto',
        'tipo_desconto',//no valor liquido ou no valor total da duplicata
        'valor_total_duplicata', 
        'valor_total_duplicata_original', 
        'data_vencimento',
        'data_pagamento',
        'data_baixa',
        'valor_pagamento',             
        'forma_pagamento_id',
        'usuario_pagamento_id',
        'conta_bancaria_id',
        'plano_conta_id',
        'houve_reativacao',
        'data_reativacao',
        'usuario_reativacao_id',
        'data_cancelamento',
        'usuario_cancelamento_id',
        'justificativa_cancelamento',
        'observacoes',
        'data_emissao',
        'usuario_cadastro_id',
        'usuario_alteracao_id',
        'historico_de_acoes_duplicata',
    ];
}
