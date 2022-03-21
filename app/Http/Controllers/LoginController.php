<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LoginRepository;

class LoginController extends Controller
{
    private $repository;

    public function __construct(LoginRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login()
    {
        return $this->repository->login();
    }

    public function autenticarUsuario(Request $request)
    {
        return $this->repository->authenticate($request);
    }

    public function logout(Request $request)
    {
        return $this->repository->logout($request);
    }

    public function verifyIdentification()
    {
        return $this->repository->verifyIdentification();
    }
}
