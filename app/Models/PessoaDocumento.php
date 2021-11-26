<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaDocumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pessoas_documentos';
    protected $guarded = ['id'];
    public $timestamps = false;
    
    /**
     * Caso queira mudar o nome dos campos de deleted_at, created_at e updated_at
     * 
     * const DELETED_AT = 'is_deleted';
     * const CREATED_AT = 'creation_date';
     * const UPDATED_AT = 'updated_date';
     * 
     */
    /**
     * TIPO_DOCUMENTO: CPF, CNPJ, PASSAPORTE, CNAE_PRINCIPAL, CNAE_SECUNDARIO
     * CARTEIRA_DE_TRABALHO, , INSCRICAO_ESTADUAL, INSCRICAO_MUNICIPAL, 
     * INSCRICAO_ESTADUAL_ST, CARTEIRA_DE_MOTORISTA (CNH), CARTEIRA_DE_IDENTIDADE (RG),
     * CARTEIRA_DE_ESTUDATE, NUMERO_MATRICULA, CRT, ETC
     */
     
    protected $fillable = [
        'pessoa_id',
        'tipo_documento', 
        'documento',
        'orgao_emissor',
        'uf_id'
    ];

    private $rulesValidation = [
        'pessoa_id'         => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
        'documento'         => ['required', 'string', 'max:60'],
        'orgao_emissor'     => ['nullale', 'string', 'max:60'],
        'uf_id'             => ['nullale', 'integer', 'min:1', 'max:9223372036854775807'],
	];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

	public function validator($data = null)
    {
        if($data)
        {   
            $validator = Validator::make($data, $this->rulesValidation);

            if($validator->passes())
            {
                return true;
            }else{
                return $validator->errors();
            }
        }
        else
        {
            return $this->rulesValidation;
        }
    }

    public function tratament($data)
    {
        return $data;
    }    
}
