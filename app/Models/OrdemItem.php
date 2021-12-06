<?php

namespace App\Models;

use App\Models\PedidoItem;

class OrdemItem extends PedidoItem
{
    protected $table = 'ordens_itens';   
    
    public function pedidos()
    {
        return $this->belongsTo(Ordem::class);
    }
}
