<?php
namespace App\Repositories;

use App\Models\Permissao;

class PermissaoRepository extends AbstractRepository
{
    public function __construct(Permissao $model)
    {
        $this->model = $model;
    }

    public function all($request = null)
    {        
        return $this->allObject(); 
    }   
}