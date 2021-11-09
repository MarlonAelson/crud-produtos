<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    private $teste;
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

    private $rulesValidation = [
		'nome'	                        => ['required', 'string', 'max:45', "unique:categorias, nome, { request()->segment(3) }, id"],
        //'categoria_pessoa'              => ['required', 'string', 'max:1'],
        //'categoria_produto_servico'     => ['required', 'string', 'max:1'],
        //'categoria_objeto_manutencao'   => ['required', 'string', 'max:1'],
		'ativo'                         => ['required', 'string', 'max:1'],
	];

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
        if(isset($data['categoria_pessoa']) && empty($data['categoria_pessoa']))
            $data['categoria_pessoa'] = 'S';
            
        if(isset($data['categoria_produto_servico']) && empty($data['categoria_produto_servico']))
            $data['categoria_produto_servico'] = 'S';
        
        if(isset($data['categoria_objeto_manutencao']) && empty($data['categoria_objeto_manutencao']))
            $data['categoria_objeto_manutencao'] = 'S';
        
        if(isset($data['ativo']) && empty($data['ativo']))
            $data['ativo'] = 'S';

        return $data;
    }

    /**
     * Quando um campo é definido como único, fica ocorrendo na alteração.
     * Portanto tem que realizar uma ajuste conforme está no array $rulesValidation
     * Esse método é para deixar setando o id de forma dinamica
     */
    public function setIgnoreColumnUniqueInMethodUpdate($id){
        return $id;
    }
    
}
