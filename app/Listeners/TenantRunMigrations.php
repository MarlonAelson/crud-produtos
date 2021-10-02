<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

use App\Events\TenantDatabaseCreated;

class TenantRunMigrations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TenantDatabaseCreated  $event
     * @return void
     */
    public function handle(TenantDatabaseCreated $event)
    {
        //recupera a tenant de App\Events\TenantDatabaseCreated
        $tenant = $event->tenant();
        //executa o comando automaticamente na empresa recuperada
        $migration = Artisan::call('tenants:migrations', [
            'id' => $tenant->id,
        ]);

        return $migration === 0;
        
        /* verifica se as migrations foram rodadas com sucesso e em seguida roda as seeders;
        if(migration === 0){
            Artisan::call('db:seed', [
                '--class' => 'xx'
            ]);
        }*///foi comentado porque já tá sendoo utilzado a mesma lógica em TenantSeeder
        
    }
}
