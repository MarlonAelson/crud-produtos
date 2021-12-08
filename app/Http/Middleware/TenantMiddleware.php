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
        ** Request()->getHost() - pegar o dominio... ex "www.sispem.com"
        ** Request()->url() - pega o domínio e o subdomínio "http://www.sispem.com/empresa/cadastro"
        ** Request()->path() - pega o subdomínio "/empresa/cadastro" ("http://www.sispem.com/empresa/cadastro")
        ** Request()->session() - cria sessão
        */

        //se for o domínio principal vai passar e olhar para a base configurada no arquivo .env
        if(TenantRepository::domainIsMain())
        {
            return $next($request);
        }
        elseif(!TenantRepository::domainIsMain() && $request->path() == '/' && TenantRepository::getTenant($request->getHost()))
        {
            $tenant = TenantRepository::getTenant($request->getHost());
            TenantRepository::setConnection($tenant);
            TenantRepository::setSession($tenant);

            return $next($request);
        }
        elseif(!TenantRepository::domainIsMain() && !$request->path() == '/')
        {
            \Log::info("URL");
            \Log::info($path);

            $identification = $request->segment(1);

            $tenant = TenantRepository::getTenant($identification);

            if(!$tenant && ($request->url() != route('404')))
            {
                return redirect()->route('404');
            }
            elseif($request->url() != route('404') && !TenantRepository::domainIsMain())
            {
                TenantRepository::setConnection($tenant);
                TenantRepository::setSession($tenant);
            }

            return $next($request);
        }
    }
}
