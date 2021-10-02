<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

class TenantRepository extends AbstractRepository
{

    public function __construct(Tenant $repository){
        $this->model = $repository;
    }

    public function create($data){
        return $this->createObject($data);
    }

    public function find($id){
        return $this->findObject($id);
    }

    public function all(){
        return $this->allObject();
    }

    //Metódo que cria o banco de dados dos tenants.
    public function createDatabase(Tenant $tenant)
    {
        //CHARSET utf8mb4 é para MYSQL, qualquer coisa depois ver uma forma de dinamizar isso.
        return DB::statement("
            CREATE DATABASE {$tenant->bd_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ");
    }

    //método responsável por fazer a conexão dinâmica nos bancos de dados;
    public static function setConnection(Tenant $tenant)
    {
        // limpa/remove os parametros da conexao tenant dentro config/database.php
        DB::purge('tenant');

        //setando a conexao dinamicamente
        config()->set('database.connections.tenant.host',     $tenant->bd_hostname);
        config()->set('database.connections.tenant.database', $tenant->bd_database);
        config()->set('database.connections.tenant.username', $tenant->bd_username);
        config()->set('database.connections.tenant.password', $tenant->bd_password);

        //conecta no banco de dados dinamicamente com a configuracao passada;
        DB::reconnect('tenant');    
    }

    //método responsável por verificar se é o domínio principal (sispem)
    public static function domainIsMain()
    {
        return request()->getHost() == config('tenant.domain_main');
    }

    public static function setSession($tenant)
    {
        session()->put('tenant', $tenant);
    }

    public static function getTenant($host)
    {
        return Tenant::where('identification', $host)->first();
    }
}