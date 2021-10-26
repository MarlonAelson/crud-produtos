<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $guarded = ['id'];

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

	public function validator($data){
        $validator = Validator::make($data, $this->regraValidacao);

        if($validator->passes()){
            return true;
        }else{
            return $validator->errors();
        }
    }

    public function tratament($data){
        return $data;
    }
    
}
