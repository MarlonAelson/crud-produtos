<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'guarde_name',
        'nome_alternativo'
    ];
   
}
