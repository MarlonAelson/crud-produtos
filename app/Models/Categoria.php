<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias';
    protected $guarded = ['id'];
    //necessário para o softdelete
    protected $dates = ['deleted_at'];
    /**
     * Caso queira mudar o nome dos campos de deleted_at, created_at e updated_at
     * 
     * const DELETED_AT = 'is_deleted';
     * const CREATED_AT = 'creation_date';
     * const UPDATED_AT = 'updated_date';
     * 
     */

    protected $fillable = [
        'nome',
        'categoria_pessoa',
        'categoria_produto_servico',
        'categoria_objeto_manutencao',
        'ativo'
    ];

    private $regraValidacao = [
		'nome'	                        => ['required', 'string', 'max:45'],
        //'categoria_pessoa'              => ['required', 'string', 'max:1'],
        //'categoria_produto_servico'     => ['required', 'string', 'max:1'],
        //'categoria_objeto_manutencao'   => ['required', 'string', 'max:1'],
		'ativo'                         => ['required', 'string', 'max:3'],
	];

	public function validator($data = null)
    {
        if($data)
        {   
            $validator = Validator::make($data, $this->regraValidacao);

            if($validator->passes())
            {
                return true;
            }else{
                return $validator->errors();
            }
        }
        else
        {
            return $this->regraValidacao;
        }
    }

    public function tratament($data)
    {
        return $data;
    }
    
}
