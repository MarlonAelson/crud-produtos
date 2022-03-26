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
        ** $response->setContent();
        ** $response->getTargetUrl()
        ** $request->segment(0);
        */
        
        //se for um dos domínios principais e tiver na url raiz (/) vai passar e olhar para a base configurada no arquivo .env
        if(TenantRepository::domainIsMain() && $request->path() == '/')
        {
            return $next($request);
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
