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
        Permissao::create(['id' => 7, 'name'=> 'categoria_alterar', 'guard_name' => 'web', 'nome_alternativo' => 'Alterar Categorias']);
        Permissao::create(['id' => 8, 'name'=> 'categoria_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Categorias']);
        Permissao::create(['id' => 9, 'name'=> 'categoria_inativar_ativar', 'guard_name' => 'web', 'nome_alternativo' => 'Inativar/Ativar Categorias']);        
        Permissao::create(['id' => 10, 'name'=> 'categoria_excluir', 'guard_name' => 'web', 'nome_alternativo' => 'Excluir Categorias']);
        Permissao::create(['id' => 11, 'name'=> 'categoria_pdf', 'guard_name' => 'web', 'nome_alternativo' => 'PDF Categorias']);

        Permissao::create(['id' => 12, 'name'=> 'pessoa_consultar', 'guard_name' => 'web', 'nome_alternativo' => 'Consultar Pessoas']);
        Permissao::create(['id' => 13, 'name'=> 'pessoa_detalhar', 'guard_name' => 'web', 'nome_alternativo' => 'Detalhar Pessoas']);
        Permissao::create(['id' => 14, 'name'=> 'pessoa_alterar', 'guard_name' => 'web', 'nome_alternativo' => 'Alterar Pessoas']);
        Permissao::create(['id' => 15, 'name'=> 'pessoa_cadastrar', 'guard_name' => 'web', 'nome_alternativo' => 'Cadastrar Pessoas']);
        Permissao::create(['id' => 16, 'name'=> 'pessoa_inativar_ativar', 'guard_name' => 'web', 'nome_alternativo' => 'Inativar/Ativar Pessoas']);        
        Permissao::create(['id' => 17, 'name'=> 'pessoa_excluir', 'guard_name' => 'web', 'nome_alternativo' => 'Excluir Pessoas']);
        Permissao::create(['id' => 18, 'name'=> 'pessoa_pdf', 'guard_name' => 'web', 'nome_alternativo' => 'PDF Pessoas']);

        Permissao::create(['id' => 19, 'name'=> 'pessoa_excel', 'guard_name' => 'web', 'nome_alternativo' => 'Excel Pessoas']);

        Permissao::create(['id' => 20, 'name'=> 'pessoa_email', 'guard_name' => 'web', 'nome_alternativo' => 'Email Pessoas']);
    }
}
