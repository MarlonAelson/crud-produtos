<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class LoginRepository
{

    // caso queira trocar o campo de autenticacao
    public function username(){
        return "nome_alternativo";
    }

    public function login()
    {
        if(env('FRONTEND_BLADE'))
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
        if(env('FRONTEND_BLADE'))
        {
            if (Auth::attempt([ 'email' => $request->nome_alternativo, 'password' => $request->password, 'acessa_sistema' => 'S', 'ativo' => 'S' ]))
            {

                $request->session()->regenerate();
                return redirect()->intended('home');
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
            return response()->json(["data" => "", "message" => "Não há padronização para esse método sem utilizar o blade do Laravel.", "errors" => true], 400);
        }
    }

    public function logout($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }   
}