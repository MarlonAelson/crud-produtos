<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PessoaRepository;

class LoginRepository extends AbstractRepository
{

    // Método responsável por trocar o campo de autenticacão
    public function username(){
        return "nome_alternativo";
    }

    public function login()
    {   
        if(env('frontend') == 'blade')
        {
            return view('login.login');
        }
        else
        {
            return response()->json(["data" => "", "message" => "Não há padronização para esse método sem utilizar o blade do Laravel.", "errors" => true], 400);
        }
    }

    public function authenticate($request)
    {   
        if(env('frontend') == 'blade')
        {
            if (Auth::attempt([ 'nome_alternativo' => $request->nome_alternativo, 'password' => $request->password, 'ativo' => 'S' ]))
            {
                $request->session()->regenerate();
                return redirect()->route('home');
            }
            else
            {
                return back()->withErrors([
                    'login' => 'The provided credentials do not match our records.',
                ]);
            }
        }
        else
        {
            if (Auth::attempt([ 'nome_alternativo' => $request->nome_alternativo, 'password' => $request->password, 'ativo' => 'S' ]))
            {
                $request->env()->regenerate();
                return response()->json(["data" => true, "message" => "Logado com sucesso.", "errors" => null], 200);
            }
        }
    }

    public function logout($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }   
}