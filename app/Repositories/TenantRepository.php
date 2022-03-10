<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use App\Events\TenantCreated;

class TenantRepository extends AbstractRepository
{

    public function __construct(Tenant $model){
        $this->model = $model;
    }

    public function store($data){
        $data = null;
        $data = [
            //'id' => $request->id,
            //'name' => $request->name,
            //'domain' => $request->domain,
            //'bd_database' => $request->bd_database,
            //'bd_hostname' => $request->bd_hostname,
            //'bd_username' => $request->bd_username,
            //'bd_password' => $request->bd_password,

            'identification' => 'tocdearte.teste',
            'type_application_navigator' => 'apu',
            'bd_create' => 'S',
            'bd_database' => 'tocdearte',
            'bd_hostname' => '127.0.0.1',
            'bd_username' => 'root',
            'bd_password' => '769SUPORTESEGURO',

            /*'identification' => 'postao.teste',
            'type_application_navigator' => 'apu',
            'bd_create' => 'S',
            'bd_database' => 'postao',
            'bd_hostname' => '127.0.0.1',
            'bd_username' => 'root',
            'bd_password' => '769SUPORTESEGURO',*/
        ];

        $returnFromFunction = $this->createObject($data);

        //verifica se é para criar o banco de dados;
        if($returnFromFunction && $data['bd_create']){
            //evento que cria o banco de dados do nosso cliente.
            event(new TenantCreated($returnFromFunction));
        }else{
            return "Cliente cadastrado sem necessidade de banco de dados, pois irá trabalhar com as empresas na mesma base.";
        }
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

    //método responsável por verificar se o domínio que está vindo é um dos principais
    public static function domainIsMain()
    {
        return in_array(request()->getHost(), config('tenant'));
    }

    public static function isTenantOld($path)
    {
        $explode = explode('/', $path);
        return self::getTenant($explode[0]);
    }

    public static function isTenant($identification)
    {
        if($tenant = self::getTenant($identification))
        {
            self::setSession($tenant);
            return redirect()->route('login');
        }
        else
        {
            self::destroySession();
            return redirect()->route('404');
        }
    }

    public static function setSession($tenant)
    {
        session()->put('tenant', $tenant['identification']);
        session()->put('tenant_type_app_nav', $tenant['type_application_navigator']);
        session()->put('tenant_complet', $tenant);
    }

    public static function destroySession()
    {
        session()->forget('tenant');
        session()->forget('tenant_type_app_nav');
        session()->forget('tenant_complet');
    }

    public static function getTenant($host)
    {
        return Tenant::where('identification', $host)->first();
    }
}
