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
        return TenantRepository::isTenant($request->identificacao);
    }
}
