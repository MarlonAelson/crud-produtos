<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([ 
            'nome' => 'CATEGORIA NÃO DEFINIDA', 
            'categoria_pessoa' => 'S', 
            'categoria_produto_servico' => 'N',
            'categoria_objeto_assistencia' => 'N',
            'ativo' => 'S'
        ]);

        Categoria::create([ 
            'nome' => 'CATEGORIA NÃO DEFINIDA', 
            'categoria_pessoa' => 'N', 
            'categoria_produto_servico' => 'S',
            'categoria_objeto_assistencia' => 'N',
            'ativo' => 'S'
        ]);

        Categoria::create([ 
            'nome' => 'CATEGORIA NÃO DEFINIDA', 
            'categoria_pessoa' => 'N', 
            'categoria_produto_servico' => 'N',
            'categoria_objeto_assistencia' => 'S',
            'ativo' => 'S'
        ]); 
    }
}
