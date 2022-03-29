<?php

namespace App\Http\Middleware;

use App\Repositories\TenantRepository;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* 
        ** IF
        ** se for um dos domínios principais, precisar de pagina de identicação do cliente (tenant) e tiver na url raiz (/)
        ** vai passar e olhar para os dados configurado no arquivo .env
        
        ** 1º ELSEIF
        ** não precisando da página de identificação direciona para a rota de login com a configuração que tá no arquivo .env.
        ** isso significa que a base é local
        
        ** 2º ELSEIF 
        ** vai passar request para, sendo um tenant, vai definir a conexão do banco de quem está vindo
        */

        if(TenantRepository::domainIsMain() && env('USE_SITE_PRELOAD') && $request->path() == '/')
        {
            return $next($request);
        }
        elseif(TenantRepository::domainIsMain() && !env('USE_SITE_PRELOAD') && $request->path() == '/')
        {
            return redirect()->route('login', ['identification' => env('IDENTIFICATION') ]);
        }
        elseif(TenantRepository::domainIsMain() && $tenant = TenantRepository::isTenant($request))
        {
            TenantRepository::setConnection($tenant);
            TenantRepository::setSession($tenant);
            return $next($request);            
        }
        elseif(!TenantRepository::domainIsMain() && !TenantRepository::isTenant($request) && ($request->url() != route('404')))
        { 
            return redirect()->route('404');
        }
        else
        {
           return response()->json('CAIU NO ELSE DO MIDDLEWARE', 400);
        }
    }
}
