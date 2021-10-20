<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
