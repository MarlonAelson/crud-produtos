<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use App\Repositories\TenantRepository;

class TenantMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //nome do meu comando, ou seja, como eu vou chamar na hora de executar
    protected $signature = 'tenants:migrations {id?} {--refresh} ';//refresh é o option
    private $tenant; //variavel que vai receber os metodos/configuracoes de conexão com o banco

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa as Migrations do banco de dadoos dos clientes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TenantRepository $tenant)
    {
        parent::__construct();

        $this->tenant = $tenant;
    }   

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //verifica se veio o arugmento id no comando. se veio é para atualizar apenas o banco de dados de uma empresa.
        if($this->argument('id')){

            //recupera a empresa.
            $tenant = $this->tenant->find($this->argument('id'));
            if($tenant)
                $this->execCommand($tenant); //encontrando a empresa, retorna para não ser executado o trecho abaixo.
            return;
        }

        //caso não veio com id recebe todas as empresas (clientes sispem) da tabela para poder no foreach criar as tabelas em todas;
        $tenants = $this->tenant->all();

        foreach($tenants as $tenant)
        {
            $this->execCommand($tenant);
        }
    }

    public function execCommand(\App\Models\Tenant $tenant){
       
        //verifica se veio o parametro para atualizar e guarda o comando necessário para ser executado.
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';
        //seta a conexao com o banco de dados da empresa 
        TenantRepository::setConnection($tenant);
            
        $this->info("Conectando ao banco de dados da empresa {$tenant->identification} e criando ou alterando as tabelas.");

        //executa o comando de migration para criar as tabelas na base de acordo com a conexão que está aberta no momento... vai executar em todas as bases até que termine
        $run = Artisan::call($command);
        /* comentado para não perder a maneira que estava
        $run = Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenant',
        ]);*/

        if($run === 0){
            Artisan::call('db:seed');
        }

        $this->info("Tabelas criadas com sucesso!");
        $this->info("----------------------------");
    }

}
