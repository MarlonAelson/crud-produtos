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

    protected $fillable = [
        'nome',
        'categoria_pessoa',
        'categoria_produto_servico',
        'categoria_objeto_manutencao',
        'ativo'
    ];

    private $regraValidacao = [
		'nome'	                        => ['required', 'string', 'max:45'],
        'categoria_pessoa'              => ['required', 'string', 'max:1'],
        'categoria_produto_servico'     => ['required', 'string', 'max:1'],
        'categoria_objeto_manutencao'   => ['required', 'string', 'max:1'],
		'ativo'                         => ['required', 'string', 'max:1'],
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
