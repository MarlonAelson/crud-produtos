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
        Permissao::create(['id' => 5,  'name'=> 'categoria_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Categorias']);
        Permissao::create(['id' => 6,  'name'=> 'categoria_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Categorias']);
        Permissao::create(['id' => 7,  'name'=> 'categoria_alterar', 'guard_name' => 'web', 'nome_alternativo' => 'Alterar Categorias']);
        Permissao::create(['id' => 8,  'name'=> 'categoria_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Categorias']);
        Permissao::create(['id' => 9,  'name'=> 'categoria_inativar_ativar', 'guard_name' => 'web', 'nome_alternativo' => 'Inativar/Ativar Categorias']);        
        Permissao::create(['id' => 10, 'name'=> 'categoria_excluir', 'guard_name' => 'web', 'nome_alternativo' => 'Excluir Categorias']);
        Permissao::create(['id' => 11, 'name'=> 'categoria_pdf', 'guard_name' => 'web', 'nome_alternativo' => 'PDF Categorias']);
        Permissao::create(['id' => 12, 'name'=> 'categoria_excel', 'guard_name' => 'web', 'nome_alternativo' => 'Excel Pessoas']);
        Permissao::create(['id' => 13, 'name'=> 'cateogira_email', 'guard_name' => 'web', 'nome_alternativo' => 'Email Pessoas']);

        Permissao::create(['id' => 14,  'name'=> 'produto_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Categorias']);
        Permissao::create(['id' => 15,  'name'=> 'produto_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Categorias']);
        Permissao::create(['id' => 16,  'name'=> 'produto_alterar', 'guard_name' => 'web', 'nome_alternativo' => 'Alterar Categorias']);
        Permissao::create(['id' => 17,  'name'=> 'produto_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Categorias']);
        Permissao::create(['id' => 18,  'name'=> 'produto_inativar_ativar', 'guard_name' => 'web', 'nome_alternativo' => 'Inativar/Ativar Categorias']);        
        Permissao::create(['id' => 19, 'name'=> 'produto_excluir', 'guard_name' => 'web', 'nome_alternativo' => 'Excluir Categorias']);
        Permissao::create(['id' => 20, 'name'=> 'produto_pdf', 'guard_name' => 'web', 'nome_alternativo' => 'PDF Categorias']);
        Permissao::create(['id' => 21, 'name'=> 'produto_excel', 'guard_name' => 'web', 'nome_alternativo' => 'Excel Pessoas']);
        Permissao::create(['id' => 22, 'name'=> 'produto_email', 'guard_name' => 'web', 'nome_alternativo' => 'Email Pessoas']);
    }
}
