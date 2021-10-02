<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TenantRepository;
use App\Events\TenantCreated;

class TenantController extends Controller
{
    //
    private $tenant;
    
    public function __construct(TenantRepository $tenant){
        $this->tenant = $tenant;
    }

    public function store(Request $request)
    {
        $tenant = $this->tenant->create([
            //'id' => $request->id,
            //'name' => $request->name,
            //'domain' => $request->domain,
            //'bd_database' => $request->bd_database,
            //'bd_hostname' => $request->bd_hostname,
            //'bd_username' => $request->bd_username,
            //'bd_password' => $request->bd_password,
            
            'identification' => 'projeto.local.com' . rand(5,10000),
            'bd_database' => 'base' . rand(5,10000),
            'bd_hostname' => '127.0.0.1',
            'bd_username' => 'root',
            'bd_password' => '769SUPORTESEGURO',
        ]);
        
        //verifica se é para criar o banco de dados;        
        if(true){
            //evento que cria o banco de dados ao salvar a base dados do cliente.
            event(new TenantCreated($tenant));
        }else{
            return "Cliente cadastrado sem necessidade de banco de dados, pois irá trabalhar com as empresas na mesma base.";
        }
        
    }
}
