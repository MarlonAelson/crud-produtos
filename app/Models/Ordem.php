<?php

namespace App\Models;

use App\Models\Pedido;

class Ordem extends Pedido
{
    protected $table = 'ordens';    

    public function itens()
    {
        return $this->hasMany(OrdemItem::class, 'pedido_id');
    }
}
