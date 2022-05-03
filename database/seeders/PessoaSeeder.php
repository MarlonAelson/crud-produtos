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
            'nome'     => 'admin',
            'nome_alternativo'    => 'admin',
            'password' => Hash::make('123456'),
            'ativo'    => 'S'
        ]);

        Pessoa::create([
            'id'       => 2, 
            'nome'     => 'usuario',
            'nome_alternativo'    => 'usuario',
            'password' => Hash::make('123456'),
            'ativo'    => 'S'
        ]);
    }
}
