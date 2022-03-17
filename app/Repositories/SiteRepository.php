<?php
namespace App\Repositories;

use App\Repositories\TenantRepository;

class SiteRepository
{
    public function index()
    {
        return view('site');
    }

    public function error404()
    {
        return view('404');
    }

    public function verifyTenant($request)
    {
        if($tenat = TenantRepository::isTenanIdentification($request->identificacao))
        {
            TenantRepository::setSession($tenant);
            return redirect()->route('login')->with('domain', $request->identificacao);
        }
        else
        {
            return redirect()->rout('404');
        }
    }
}
