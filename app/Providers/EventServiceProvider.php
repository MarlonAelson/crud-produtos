<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //chama o evento responsável por criar o banco de dados.
        'App\Events\TenantCreated' => [
            'App\Listeners\TenantCreateDatabase'
        ],
        
        //chama o evento responsável por criar as tabelas no banco de dados.
        'App\Events\TenantDatabaseCreated' => [
            'App\Listeners\TenantRunMigrations',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }
}
