<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    protected $guarded = ['id'];

    protected $fillable = [
        'nome',
        'sigla'
    ];

    public function produtos()
    {
        return $this->hasOne(Unidade::class);
    }
}
