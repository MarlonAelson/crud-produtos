<?php

namespace App\Http\Middleware;

use App\Repositories\TenantRepository;
use Closure;

class VerifyTenantPermited
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
        else
        {
            return redirect()->route('404');
        }
    }
}
