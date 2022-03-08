<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TenantRepository;

//use App\Repositories\SiteRepository;

class SiteController extends Controller
{
    //
    //private $repository;
    
    /*
    ** Método responsável por retornar a listagem
    ** de objetos. Também será utilizado para rea-
    ** lizar buscas.
    */
    public function index()
    {   
        return view('site');     
    }

    /* 
    ** 
    ** 
    */
    public function error404()
    {
        return view('404');
    }

    public function verifyTenant(Request $request)
    {
        return TenantRepository::verifyTenant($request);
    }
}
