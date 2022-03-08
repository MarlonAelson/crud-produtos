<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParametroEmpresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parametros_empresas';
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
        'pessoa_id',
        'forma_envio_email',
    ];

    private $rulesValidation = [
		//'nome'	                        => ['required', 'string', 'max:45', "unique:categorias, nome, {ignore()}, id"],
        'pessoa_id'	                      => ['required', 'integer', 'min:1', 'max:9223372036854775807'],
        'forma_envio_email'	              => ['required', 'string', 'max:45'],
        //'categoria_pessoa'              => ['required', 'string', 'max:1'],
        //'categoria_produto_servico'     => ['required', 'string', 'max:1'],
        //'categoria_objeto_manutencao'   => ['required', 'string', 'max:1'],
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
        /*if(empty($data['categoria_pessoa']))
            $data['categoria_pessoa'] = 'S';*/

        return $data;
    }

    /**
     * Quando um campo é definido como único, fica ocorrendo na alteração.
     * Portanto tem que realizar uma ajuste conforme está no array $rulesValidation
     * Esse método é para deixar setando o id de forma dinamica
     */
    public function ignoreColumnUniqueInMethodUpdate(){
        return request()->segment(3);
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
    
}
