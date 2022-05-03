<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProdutoRepository;
use App\Exports\ProdutoExport;
use Maatwebsite\Excel\Facades\Excel;

class ProdutoController extends Controller
{
    private $repository;

    public function __construct(ProdutoRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /*
    ** Método responsável por retornar a listagem
    ** de todos os objetos. 
    */
    public function index()
    {   
        return $this->repository->all();      
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
    * Método responsável por pesquisar (de forma simples ou avançada) 
    * objeto(s) no BD.
    */
    public function search(Request $request)
    {   
        return $this->repository->search($request);
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
    * Método responsável por gerar pdf dos objeto
    */
    public function pdf(Request $request)
    {       
        return $this->repository->pdf($request);
    }

    /**
    * Método responsável por enviar os e-mails dos objetos
    * no BD.
    */
    public function email(Request $request)
    {       
        return $this->repository->email($request);
    }

    /**
    * Método responsável por gerar o excel dos objetos
    */
    public function excel(Request $request)
    {   
        return new ProdutoExport();
        //return (new ProdutoExport)->download('invoices.xlsx', \Maatwebsite\Excel\Facades\Excel::XLSX);
        //return Excel::download(new ProdutoExport, 'produto1.XLSX');
        //return $this->repository->email($request);
    }
}
