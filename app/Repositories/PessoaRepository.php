<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Pessoa;
use App\Repositories\PermissaoRepository;

class PessoaRepository extends AbstractRepository
{
    private $personaliteView = [];
    private $dependencias;

    public function __construct(Pessoa $model, PermissaoRepository $dependencia1)
    {
        $this->model = $model;
        $this->dependencias = $dependencia1;
    }

    public function all($request)
    {        
        $all      = $this->allObject();
        $pathUrl  = $request->path();
        
        $objetos  = $this->definicaoPessoa($all, $pathUrl);

        if(env('FRONTEND_BLADE'))
        {
            return view('list',[
                'objetos' => $objetos, 
                'qtdRegistros' => 10,
                'informacoesComunsViews' => $this->getDataCommomViews($pathUrl)
            ]);
        } 
    }

    public function form($request)
    {
        $pathUrl = $request->path();

        if(env('FRONTEND_BLADE'))
        {
            return view('form',[
                'dependencias' => $this->dependencias->all(),
                'informacoesComunsViews' => $this->getDataCommomViews($pathUrl)
            ]);
        }
    }

    public function create($data)
    {
        return $this->createObject($data);
    }

    public function find($id)
    {
        return $this->findObject($id);
    }

    public function definicaoPessoa($all, $pathUrl)
    {
        switch(substr($pathUrl, 0, -5))
        {
            case 'clientes':
                return $all->where('cliente', 'S');
            case 'fornecedores':
                return $all->where('fornecedor', 'S');
            case 'usuarios':
                return $all->where('acessa_sistema', 'S');
            case 'colaborador':
                return $all->where('colaborador', 'S');
            case 'empresas':
                return $all->where('empresa', 'S');
            case 'outro':
                return $all->where('outro', 'S');
            default: $all;
        } 
    }

    public static function getClientes()
    {
        return $this->model->where('cliente', 'S')->where('ativo', 'S')->get();
    }

    public static function getFornecedores()
    {
        return $this->model->where('fornecedor', 'S')->where('ativo', 'S')->get();
    }

    public static function getUsuarios()
    {
        return $this->model->where('acessa_sistema', 'S')->where('ativo', 'S')->get();
    }

    public static function getColaboradores()
    {
        return $this->model->where('colaborador', 'S')->where('ativo', 'S')->get();
    }

    public static function getEmpresas()
    {
        return $this->model->where('empresa', 'S')->where('ativo', 'S')->get();
    }

    public static function getOutros()
    {
        return $this->model->where('outro', 'S')->where('ativo', 'S')->get();
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
        
        if($data){
            switch(substr($data, 0, -5))
            {
                case 'clientes':
                    $this->personaliteView['label_card_form'] = "Cadastrar Cliente";
                    $this->personaliteView['label_card_edit'] = "Alterar Cliente";
                    $this->personaliteView['label_card_list'] = "Listagem de Clientes";
                    $this->personaliteView['route_name_view'] = "pessoas";
                    break;
                case 'fornecedores':
                    $this->personaliteView['label_card_form'] = "Cadastrar Fornecedor";
                    $this->personaliteView['label_card_edit'] = "Alterar Fornecedor";
                    $this->personaliteView['label_card_list'] = "Listagem de Fornecedores";
                    $this->personaliteView['route_name_view'] = "fornecedores";
                    break;
                case 'usuarios':
                    $this->personaliteView['label_card_form'] = "Cadastrar Usuário";
                    $this->personaliteView['label_card_edit'] = "Alterar Usuário";
                    $this->personaliteView['label_card_list'] = "Listagem de Usuários";
                    $this->personaliteView['route_name_view'] = "usuarios";
                    break;
                case 'colaborador':
                    $this->personaliteView['label_card_form'] = "Cadastrar Usuário";
                    $this->personaliteView['label_card_edit'] = "Alterar Usuário";
                    $this->personaliteView['label_card_list'] = "Listagem de Usuários";
                    $this->personaliteView['route_name_view'] = "usuarios";
                case 'empresas':
                    $this->personaliteView['label_card_form'] = "Cadastrar Usuário";
                    $this->personaliteView['label_card_edit'] = "Alterar Usuário";
                    $this->personaliteView['label_card_list'] = "Listagem de Usuários";
                    $this->personaliteView['route_name_view'] = "usuarios";
                case 'pessoas':
                    $this->personaliteView['label_card_form'] = "Cadastrar Pessoa";
                    $this->personaliteView['label_card_edit'] = "Alterar Pessoa";
                    $this->personaliteView['label_card_list'] = "Listagem de Pessoas";
                    $this->personaliteView['route_name_view'] = "pessoas";
            }
        }
        
        return $this->personaliteView;
    }
}