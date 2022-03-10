<?php

namespace App\Http\Middleware;

use App\Repositories\TenantRepository;
use Closure;

class SetDBConnectionForTenant
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
        TenantRepository::setConnection(session('tenant_complet'));
        return $next($request);
        /*
        elseif(!TenantRepository::domainIsMain() && !TenantRepository::isTenant($request->path()) && ($request->url() != route('404')))
        { 
            return redirect()->route('404');
        }
        else
        {
            return response()->json('CAIU NO ELSE DO MIDDLEWARE', 400);
        }*/
    }
}
