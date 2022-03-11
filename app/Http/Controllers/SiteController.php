<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SiteRepository;

class SiteController extends Controller
{
    private $repository;

    public function __construct(SiteRepository $repository)
    {
       $this->repository = $repository; 
    }
    
    public function index()
    {   
        return $this->repository->index();     
    }

    public function error404()
    {
        return $this->repository->error404();
    }

    public function verifyTenant(Request $request)
    {
        return $this->repository->verifyTenant($request);
    }
}
