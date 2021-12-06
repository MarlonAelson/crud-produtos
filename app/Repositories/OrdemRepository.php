<?php
namespace App\Repositories;

use App\Models\Ordem;

class OrdemRepository extends PedidoRepository
{
    public function __construct(Ordem $model)
    {
        parent::__construct($model);
    }

    public function labelsCommomFrontEnd($name = null)
    {
        $personalization['informative_search'] = "Pesquise digitando o nome da Ordem desejada";
        $personalization['label_card_form'] = "Cadastrar Ordem";
        $personalization['label_card_edit'] = "Alterar Ordem";
        $personalization['label_card_list'] = "Consultar Ordems";
        $personalization['route_name_view'] = "ordens";
        
        return $personalization;
    }

    public function all($request = null)
    {
        return parent::all($request);
    }

    public function store($request)
    {
        return parent::store($request);
    }
    
    public function show($request)
    {
        return parent::show($request);
    }

    public function update($request)
    {
        return parent::update($request);
    }

    public function delete($request)
    {
        return parent::delete($request);
    }

    public function inactiveOrActive($request)
    {
        return parent::inactiveOrActive($request);
    }

    public function replicate($request)
    {
        return parent::replicate($request);
    }

    public function pdf()
    {
        return parent::pdf();
    }

    public function email()
    {
        return parent::email();
    }

    /**
     * Os Métodos abaixos: create e edit - são específicos para quando o projeto for com blade
     */

    public function create($request)
    {
        return parent::create($request);
    }

    public function edit($request)
    {
        return parent::edit($request);
    }
}