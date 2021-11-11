<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsuarioPermissao;

class UsuarioPermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsuarioPermissao::create(['permission_id' => 1, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 2, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 3, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);     
        UsuarioPermissao::create(['permission_id' => 4, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);       
        UsuarioPermissao::create(['permission_id' => 5, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 6, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 7, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 8, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 9, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 10, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
        UsuarioPermissao::create(['permission_id' => 11, 'model_type'=> 'App\Models\Pessoa', 'model_id' => 1]);
    }
}
