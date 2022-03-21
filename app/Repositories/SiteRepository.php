<?php
namespace App\Repositories;

use App\Repositories\TenantRepository;

class SiteRepository
{
    public function index()
    {
        return view('site');
        /*$databaseApplication = env('DB_SERVER', 'web'); 
        if($databaseApplication == 'local'){
            return route('login');
        }else{
            return view('site');
        }*/
    }

    public function error404()
    {
        return view('404');
    }
}
