<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrdemRepository;

class OrdemController extends Controller
{
    private $repository;

    public function __construct(OrdemRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /*
    ** Método responsável por retornar a listagem
    ** de objetos. Também será utilizado para rea-
    ** lizar buscas.
    */
    public function index(Request $request)
    {   
        return $this->repository->all($request);      
    }

    /* 
    ** Método para retornar o form de cadastro se
    ** estiver usando blade.
    */
    public function create(Request $request)
    {
        return $this->repository->create($request);
    }

    /*
    ** Método responsável por criar objeto no BD.
    */
    public function store(Request $request)
    {
        return $this->repository->store($request); 
    }

    /*
    * Método responsável por exibir detalhes do objeto.
    */
    public function show(Request $request)
    {
        return $this->repository->show($request);
    }
    
    /**
     * Método responsável por retornar o form de edição 
     * se estiver usando blade.
     */
    public function edit(Request $request)
    {
        return $this->repository->edit($request);
    }

    /**
    * Método responsável por salvar as alterações do obje-
    * to no BD.
    */
    public function update(Request $request)
    {
        return $this->repository->update($request);
    }

    /**
    * Método responsável por excluir o objeto no BD. 
    * Está usando o softdelete do Laravel para evi-
    * tar problemas.
    */
    public function destroy(Request $request)
    {
        return $this->repository->delete($request);
    }

    /**
    * Método responsável por inativar/ativar um objeto
    * no BD.
    */
    public function inactiveOrActive(Request $request)
    {       
        return $this->repository->inactiveOrActive($request);
    }

    /**
    * Método responsável por clonar e salvar um objeto
    * no BD.
    */
    public function replicate(Request $request)
    {       
        return $this->repository->replicate($request);
    }

    /**
    * Método responsável por clonar e salvar um objeto
    * no BD.
    */
    public function pdf(Request $request)
    {       
        return $this->repository->pdfObjects($request);
    }

    /**
    * Método responsável por enviar os e-mails dos objetos
    * no BD.
    */
    public function email(Request $request)
    {       
        return $this->repository->email($request);
    }
}
