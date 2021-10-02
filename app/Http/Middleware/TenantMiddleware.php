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
        //se for o domínio principal o cliente não utilizar bancos de dados separados vai se conectar na base configurada no .env
        if(TenantRepository::domainIsMain())
            return $next($request);

        $tenant = TenantRepository::getTenant($request->getHost());
        
        if(!$tenant && ($request->url() != route('404'))){
            return redirect()->route('404');
        }else if($request->url() != route('404') && !TenantRepository::domainIsMain()) {           
            TenantRepository::setConnection($tenant);
            TenantRepository::setSession($tenant->only(['identification']));
        }      
    
        return $next($request);
    }
}
