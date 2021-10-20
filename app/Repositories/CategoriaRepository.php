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
        $this->personaliteView['informativo_pesquisa'] = "Pesquise por ...";
        $this->personaliteView['simbolo_obrigatoriedade_inputs'] = '*';
        $this->personaliteView['obrigatoriedade_inputs'] = true;
        /*$colunasDaTabelaDoGrid = ['', '',''];
        $tamanhoColunaDosCampos = [4,4,4];*/
        $this->personaliteView['qtd_max_caracteres_inputs'][20]   = 20;
        $this->personaliteView['qtd_max_caracteres_inputs'][45]   = 45;
        $this->personaliteView['qtd_max_caracteres_inputs'][60]   = 60;
        $this->personaliteView['qtd_max_caracteres_inputs'][120]  = 120;
        //$this->personaliteView['required'] =  true; Vou deixar para o validator do laravel mesmo;
        
        $this->personaliteView['label_card_form'] = "Cadastrar Categoria";
        $this->personaliteView['label_card_edit'] = "Alterar Categoria";
        $this->personaliteView['label_card_list'] = "Consultar Categorias";
        $this->personaliteView['route_name_view'] = "categorias";
        
        return $this->personaliteView;
    }

    public function all($request = null)
    {        
        $objetos = $this->allObject();
        
        if(env('FRONTEND_BLADE'))
        {
            return view('list',[
                'objetos' => $objetos, 
                'qtdRegistros' => 10,
                'informacoesComunsViews' => $this->getDataCommomViews()
            ]);
        } 
    }

    public function form($request)
    {
        if(env('FRONTEND_BLADE'))
        {
            return view('form',[
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