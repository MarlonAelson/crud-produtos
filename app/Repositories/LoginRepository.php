<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PessoaRepository;

class LoginRepository extends AbstractRepository
{

    // caso queira trocar o campo de autenticacao
    public function username(){
        return "nome_alternativo";
    }

    public function login()
    {
        if(env('FRONTEND_BLADE'))
        {
            return view('login.login', ['companies' => PessoaRepository::getCompanies()]);
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
            if (Auth::attempt([ 'nome_alternativo' => $request->nome_alternativo, 'password' => $request->password, 'acessa_sistema' => 'S', 'ativo' => 'S' ]))
            {
                
                $request->session()->regenerate();
                $request->session()->put('empresa_id', $request->empresa_id);
                return redirect()->intended('home');
                
                /*Utilizado para testes
                return view('home', [
                    "teste_empresa" => $this->getCompanyId(),
                    "teste_usuario" => $this->getUserId()
                ]);*/
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