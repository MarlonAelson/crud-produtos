<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissao;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permissao::create(['id' => 1, 'name'=> 'usuario_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Usuários']);
        Permissao::create(['id' => 2, 'name'=> 'usuario_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Usuários']);
        Permissao::create(['id' => 3, 'name'=> 'usuario_editar', 'guard_name' => 'web', 'nome_alternativo' => 'Editar Usuários']);
        Permissao::create(['id' => 4, 'name'=> 'usuario_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Usuários']);
        
        Permissao::create(['id' => 5, 'name'=> 'categoria_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Categorias']);
        Permissao::create(['id' => 6, 'name'=> 'categoria_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Categorias']);
        Permissao::create(['id' => 7, 'name'=> 'categoria_editar', 'guard_name' => 'web', 'nome_alternativo' => 'Editar Categorias']);
        Permissao::create(['id' => 8, 'name'=> 'categoria_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Categorias']);
    }
}
