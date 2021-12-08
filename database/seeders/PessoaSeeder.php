<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Pessoa;
use Illuminate\Support\Facades\Hash;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::create([
            'id'       => 1, 
            'nome'     => 'Marlon',
            'nome_alternativo'    => 'MARLON',
            'colaborador' => 'S',
            'empresa' => 'N',
            'cliente' => 'N',
            'fornecedor' => 'N',
            'outros' => 'N',
            'password' => Hash::make('123456'),
            'acessa_sistema' => 'S',
            'ativo'    => 'S'
        ]);

        Pessoa::create([
            'id'       => 2, 
            'nome'     => 'SISPEM LTDA',
            'nome_alternativo'    => 'SISPEM',
            'colaborador' => 'N',
            'empresa' => 'S',
            'cliente' => 'N',
            'fornecedor' => 'N',
            'outros' => 'N',
            'password' => Hash::make('123456'),
            'acessa_sistema' => 'S',
            'ativo'    => 'S'
        ]);

        Pessoa::create([
            'id'       => 3,
            'nome'     => 'TOC DE ARTE LTDA',
            'nome_alternativo'    => 'TOC DE ARTE',
            'colaborador' => 'N',
            'empresa' => 'S',
            'cliente' => 'N',
            'fornecedor' => 'N',
            'outros' => 'N',            
            'password' => Hash::make('123456'),
            'acessa_sistema' => 'S',
            'ativo'    => 'S'
        ]);
    }
}
