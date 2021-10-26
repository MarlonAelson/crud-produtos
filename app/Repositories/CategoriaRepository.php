<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaRepository extends AbstractRepository
{
    private $personaliteView = [];
    
    public function __construct(Categoria $model)
    {
        $this->model = $model;
    }

    public function getDataCommomViews($data = null)
    {
        $this->personaliteView['informativo_pesquisa'] = "Pesquise digitando o nome da categoria desejada";
        $this->personaliteView['label_card_form'] = "Cadastrar Categoria";
        $this->personaliteView['label_card_edit'] = "Alterar Categoria";
        $this->personaliteView['label_card_list'] = "Consultar Categorias";
        $this->personaliteView['route_name_view'] = "categorias";
        
        return $this->personaliteView;
    }

    public function all($request = null)
    {                 
        $objects = $this->allObject();
        $result;

        if($objects)
        {
            $this->result = ['data'=> $objects, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possivel carregar os registros.', 'errors'=> true];
        }          
        
        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->getDataCommomViews()['route_name_view']}.list",[
                'objetos' => $this->result, 
                'qtdRegistros' => 10,
                'informacoesComunsViews' => $this->getDataCommomViews()
            ]);
        } 
        else
        {
            return response()->json($this->result, 200);
        }
    }

    public function create($request)
    {
        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->getDataCommomViews()['route_name_view']}.form",[
                'informacoesComunsViews' => $this->getDataCommomViews()
            ]);
        }
    }
    
    public function store($data)
    {
        if($this->createObject($data))
        {
           return $this->all();
        }
    }
}