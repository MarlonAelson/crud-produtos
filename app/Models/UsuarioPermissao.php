<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPermissao extends Model
{
    use HasFactory;

    protected $table = 'model_has_permissions';
    public $timestamps = false;

    protected $fillable = [
        'permission_id', //id da tabela permission
        'model_type', //nome do model de usuário da seguinte forma App\Models\Pessoa
        'model_id' //esse é o id do usuário (no nosso caso o usuário é na tabela pessoa)
    ];

    public function permissoes()
	{
		return $this->belongsTo(Permissao::class, 'permission_id');
	}

	public function pessoas()
	{
		return $this->belongsTo(Pessoa::class, 'model_id');
	}
   
}
