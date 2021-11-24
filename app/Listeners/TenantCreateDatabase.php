<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\TenantDatabaseCreated;
use App\Events\TenantCreated;
use App\Repositories\TenantRepository;

class TenantCreateDatabase
{
    private $tenantRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * Handle the event.
     *
     * @param  TenantCreated  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        //recupera a empresa cadastrada (metodo criado App\Events\TenantCreated)
        $tenant = $event->tenant();

        //cria a base de dados de forma automatica após cadastrar o cliente na nossa base
        if(!$this->tenantRepository->createDatabase($tenant)){
            throw new \Exception('Erro ao criar database');
        }

        //após a criacao da base executa as migrations
        event(new TenantDatabaseCreated($tenant));
    }
}
