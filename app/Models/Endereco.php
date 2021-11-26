<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';
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

    protected $fillable = [
        //'tipo_endereco', //NFE_PRINCIPAL, NFE_ENTREGA, NFE_RETIRADA
        'pessoa_id',
        'nome',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade_id',
        'estado_id',
        'pais_id'
    ];

    private $rulesValidation = [
        /* 'pessoa_id'                     => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
        'nome'	                        => ['required', 'string', 'max:45'],
        'logradouro'                    => ['required', 'string', 'min:3', 'max:60'],
        'numero'                        => ['required', 'string', 'max:60'],
        'complemento'                   => ['nullable', 'string', 'max:60'],
		'bairro'                        => ['required', 'string', 'min:3', 'max:60'],
        'cidade_id'                     => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
        'estado_id'                     => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
        'pais_id'                       => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
 */	];

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

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
}
