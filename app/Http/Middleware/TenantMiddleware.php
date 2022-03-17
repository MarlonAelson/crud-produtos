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

        //se for um dos domínios principais e tiver na url raiz (/) vai passar e olhar para a base configurada no arquivo .env
        if(TenantRepository::domainIsMain() && ($request->path() == '/' || $request->path() == 'verifyTenant'))
        {
            return $next($request);
        }
        elseif($tenant = TenantRepository::isTenantPath($request->path()))
        {
            TenantRepository::setConnection($tenant);
            dd($next($request));
            return $next($request);
            /**
             * $callback = function ($value) {
    return is_numeric($value) ? $value * 2 : 0;
};
 
$result = with(5, $callback);
 
// 10
 
$result = with(null, $callback);
 
// 0
 
$result = with(5, null);
             * 
             * 
             */
        }
        elseif(!TenantRepository::domainIsMain() && !TenantRepository::isTenant($request->path()) && ($request->url() != route('404')))
        { 
            return redirect()->route('404');
        }
        else
        {
            return response()->json('CAIU NO ELSE DO MIDDLEWARE', 400);
        }
    }
}
