<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Pessoa;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
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
            'nome'     => 'Administrador',
            'email'    => 'admin@sistema.com',
            'password' => Hash::make('admin123'),
            'acessa_sistema' => 'S',
            'login'    => 'admin123',
            'ativo'    => 'S'
        ]);

        Pessoa::create([
            'id'       => 2,
            'nome'     => 'Usuário Comum',
            'email'    => 'usuario@sistema.com',
            'password' => Hash::make('usuario123'),
            'acessa_sistema' => 'S',
            'login'    => 'usuario123',
            'ativo'    => 'S'
        ]);
    }
}
