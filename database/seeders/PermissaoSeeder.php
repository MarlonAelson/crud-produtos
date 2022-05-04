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
        Permissao::create(['id' => 1,  'name'=> 'produto_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Categorias']);
        Permissao::create(['id' => 2,  'name'=> 'produto_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Categorias']);
        Permissao::create(['id' => 3,  'name'=> 'produto_alterar', 'guard_name' => 'web', 'nome_alternativo' => 'Alterar Categorias']);
        Permissao::create(['id' => 4,  'name'=> 'produto_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Categorias']);
        Permissao::create(['id' => 5,  'name'=> 'produto_inativar_ativar', 'guard_name' => 'web', 'nome_alternativo' => 'Inativar/Ativar Categorias']);        
        Permissao::create(['id' => 6, 'name'=> 'produto_excluir', 'guard_name' => 'web', 'nome_alternativo' => 'Excluir Categorias']);
        Permissao::create(['id' => 7, 'name'=> 'produto_pdf', 'guard_name' => 'web', 'nome_alternativo' => 'PDF Categorias']);
        Permissao::create(['id' => 8, 'name'=> 'produto_email', 'guard_name' => 'web', 'nome_alternativo' => 'Email Pessoas']);
    }
}
