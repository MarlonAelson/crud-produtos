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

    public function labelsCommomFrontEnd($data = null)
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
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível carregar os registros do banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }
        
        /*
        **analisar se a condição de status vai permanecer
        **pois nada muda praticamente
        */
        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objetos' => $this->result, 
                'qtdRegistros' => 10,
                'informacoesComunsViews' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objetos' => $this->result, 
                'qtdRegistros' => 0,
                'informacoesComunsViews' => $this->labelsCommomFrontEnd()
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
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.form",[
                'informacoesComunsViews' => $this->labelsCommomFrontEnd()
            ]);
        }
    }

    public function edit($request)
    {
        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.edit",[
                'informacoesComunsViews' => $this->labelsCommomFrontEnd()
            ]);
        }
    }
    
    public function store($request)
    {
        $result;
        $status;
        $validacao = $this->model->validator($request->all());

        if($validacao === true)
        {
            $dadosTratados = $this->model->tratament($request->all());
            $retorno = $this->createObject($dadosTratados);

            if($retorno)
            {
                $this->result = ['data'=> $retorno, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
                $this->status = 200;
            }
            else
            {
                $this->result = ['data'=> null, 'mensagem' =>'Não foi possivel salvar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
                $this->status = 400;
            }

            if(env('FRONTEND_BLADE'))
            {
                /*return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                    'objetos' => $this->result, 
                    'qtdRegistros' => 10,
                    'informacoesComunsViews' => $this->labelsCommomFrontEnd()
                ]);*/
                return $this->all();
            } 
            else
            {
                return response()->json($this->result, $this->status);
            }
        }
        else
        {
            if(env('FRONTEND_BLADE'))
            {
                return redirect()
                       ->back()
                       ->withErrors( $validacao );
            
            } 
            else
            {
                return response()->json(['data'=> null, 'mensagem' => $validacao, 'errors'=> true], 201);//$this->result e $this->status
            }
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
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível excluir o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }          

        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors( $this->result['mensagem'] );
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($this->result, $this->status);
        }
    }

    public function inactiveOrActive($request)
    {
        $result;
        $status;
        $retorno = $this->inactiveOrActiveObject($request->id);
        
        if($retorno)
        {
            $this->result = ['data'=> $retorno, 'mensagem' =>'Registro inativado ou ativado com sucesso.', 'errors'=> null];
            $this->status = 200;
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível inativar ou ativar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }          

        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors( $this->result['mensagem'] );
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($this->result, $this->status);
        }
    }

    public function show($request)
    {
        $result;
        $status;
        $retorno = $this->showObject($request->id);
        
        if($retorno)
        {
            $this->result = ['data'=> $retorno, 'mensagem' =>'Registro detalhado com sucesso.', 'errors'=> null];
            $this->status = 200;
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível carregar os detalhes do registro. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $this->status = 400;
        }          

        if( env('FRONTEND_BLADE') && $this->status == 200 )
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif( env('FRONTEND_BLADE') && $this->status == 400 )
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors( $this->result['mensagem'] );
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($this->result, $this->status);
        }
    }
}