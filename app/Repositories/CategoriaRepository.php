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
        $result;
        $status;               
        $retorno = $this->allObject();

        if($retorno)
        {
            $this->result = ['data'=> $retorno, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
            $this->status = 200;
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível carregar os registros. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }
        
        /*
        **analisar se a condição de status vai permanecer
        **pois nada muda praticamente
        */
        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return view("{$this->getDataCommomViews()['route_name_view']}.list",[
                'objetos' => $this->result, 
                'qtdRegistros' => 10,
                'informacoesComunsViews' => $this->getDataCommomViews()
            ]);
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return view("{$this->getDataCommomViews()['route_name_view']}.list",[
                'objetos' => $this->result, 
                'qtdRegistros' => 0,
                'informacoesComunsViews' => $this->getDataCommomViews()
            ])->withErrors( $this->result );
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($this->result, $this->status);
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
    
    public function store($request)
    {
        $result;

        $validacao = $this->model->validator($request->all());

        if($validacao === true)
        {
            $dadosTratados = $this->model->tratament($request->all());
            $retorno = $this->createObject($dadosTratados);

            if($retorno)
            {
                $this->result = ['data'=> $retorno, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
            }
            else
            {
                $this->result = ['data'=> null, 'mensagem' =>'Não foi possivel salvar o registro no banco  de dados. Entre em contato com o suporte do sistema.', 'errors'=> true];
            }

            if(env('FRONTEND_BLADE'))
            {
                /*return view("{$this->getDataCommomViews()['route_name_view']}.list",[
                    'objetos' => $this->result, 
                    'qtdRegistros' => 10,
                    'informacoesComunsViews' => $this->getDataCommomViews()
                ]);*/
                return $this->all();
            } 
            else
            {
                return response()->json($this->result, 200);
            }
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' => $validacao, 'errors'=> true];
        }
    }

    public function delete($request)
    {
        $result;
        $status;
        $retorno = $this->deleteObject($request->id);
        
        if($retorno)
        {
            $this->result = ['data'=> $retorno, 'mensagem' =>'Registro excluído com sucesso.', 'errors'=> null];
            $this->status = 200;
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível excluir o registro. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }          

        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return redirect()->route("{$this->getDataCommomViews()['route_name_view']}.index");
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return redirect()
                    ->route('categorias.index')
                    ->withErrors( $this->result['mensagem'] );
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($this->result, $this->status);
        }
    }
}