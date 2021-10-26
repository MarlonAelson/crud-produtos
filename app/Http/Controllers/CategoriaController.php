<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoriaRepository;

class CategoriaController extends Controller
{
    private $repository;

    public function __construct(CategoriaRepository $repository)
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
        return $this->repository->store($request->all()); 
    }

    /*
    * Método responsável por exibir detalhes do objeto.
    */
    public function show(Request $request)
    {
        return $this->repository->show($request->id);
    }
    
    /**
     * Método responsável por retornar o form de edição 
     * se estiver usando blade.
     */
    public function edit(Request $request)
    {
        return $this->repository->show($request->id);
    }

    /**
    * Método responsável por salvar as alteraçõesdo obje-
    * to no BD.
    */
    public function update(Request $request, $id)
    {
        return $this->repository->update($request->all(), $request->id);
    }

    /**
    * Método responsável por excluir o objeto no BD. 
    * Prefiro usar o softdelete do Laravel para evi-
    * tar problemas.
    */
    public function destroy($id)
    {
        return $this->repository->update($request->all(), $request->id);
    }

    /**
    * Método responsável por inativar/ativar um objeto
    * no BD.
    */
    public function inactiveOrActive(Request $request)
    {       
        return $this->repository->inactiveOrActive($request->id);
    }
}
