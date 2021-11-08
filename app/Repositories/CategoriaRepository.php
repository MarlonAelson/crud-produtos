<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaRepository extends AbstractRepository
{
    public function __construct(Categoria $model)
    {
        $this->model = $model;
    }

    public function labelsCommomFrontEnd()
    {
        $personalization['informativo_pesquisa'] = "Pesquise digitando o nome da categoria desejada";
        $personalization['label_card_form'] = "Cadastrar Categoria";
        $personalization['label_card_edit'] = "Alterar Categoria";
        $personalization['label_card_list'] = "Consultar Categorias";
        $personalization['route_name_view'] = "categorias";
        
        return $personalization;
    }

    public function all($request = null)
    {  
        $result;
        $status;               
        $returnFromFunction = $this->allObject();

        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'mensagem' =>'Não foi possível carregar os registros do banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }
        
        /*
        **analisar se a condição de status vai permanecer
        **pois nada muda praticamente
        */
        if( env('FRONTEND_BLADE') && $status == 200 )
        {   
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objetos' => $result, 
                'qtdRegistros' => 10,
                'informacoesComunsFront' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif( env('FRONTEND_BLADE') && $status == 400 )
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objetos' => $result, 
                'qtdRegistros' => 0,
                'informacoesComunsFront' => $this->labelsCommomFrontEnd()
            ])->withErrors( $result );
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
        }
    }
    
    public function store($request)
    {
        $result;
        $status;
        $validation;

        if(env('FRONTEND_BLADE'))
        {
            $request->validate($this->model->validator());
            $validation = true;
        }
        else
        {
            $validation = $this->model->validator($request->all());
        }

        if($validation === true)
        {
            $dadosTratados = $this->model->tratament($request->all());
            $returnFromFunction = $this->createObject($dadosTratados);

            if($returnFromFunction)
            {
                $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
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
                    'informacoesComunsFront' => $this->labelsCommomFrontEnd()
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
            return response()->json(['data'=> null, 'mensagem' => $validation, 'errors'=> true], 201);//$this->result e $this->status
        }
    }

    public function show($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->findObject($request->id);
        
        if($returnFromFunction)
        {
            $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registro detalhado com sucesso.', 'errors'=> null];
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

    public function update($request)
    {
        $result;
        $status;
        $validation;

        if(env('FRONTEND_BLADE'))
        {
            $request->validate($this->model->validator());
            $validation = true;
        }
        else
        {
            $validation = $this->model->validator($request->all());
        }

        if($validation === true)
        {
            $dadosTratados = $this->model->tratament($request->all());
            $returnFromFunction = $this->createObject($dadosTratados);

            if($returnFromFunction)
            {
                $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registros carregados com sucesso.', 'errors'=> null];
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
                    'informacoesComunsFront' => $this->labelsCommomFrontEnd()
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
            return response()->json(['data'=> null, 'mensagem' => $validation, 'errors'=> true], 201);//$this->result e $this->status
        }
    }

    public function delete($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->deleteObject($request->id);
        
        if($returnFromFunction)
        {
            $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registro excluído com sucesso.', 'errors'=> null];
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
        $returnFromFunction = $this->inactiveOrActiveObject($request->id);
        
        if($returnFromFunction)
        {
            $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registro inativado ou ativado com sucesso.', 'errors'=> null];
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

    public function replicate($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->replicateObject($request->id);
        
        if($returnFromFunction)
        {
            $this->result = ['data'=> $returnFromFunction, 'mensagem' =>'Registro clonado com sucesso.', 'errors'=> null];
            $this->status = 200;
        }
        else
        {
            $this->result = ['data'=> null, 'mensagem' =>'Não foi possível clonar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
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

    /**
     * Os Métodos abaixos: create e edit - são específicos para quando o projeto for com blade
     */
    public function create($request)
    {
        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.form",[
                'informacoesComunsFront' => $this->labelsCommomFrontEnd()
            ]);
        }
    }

    public function edit($request)
    {
        $returnFromFunction = $this->findObject($request->id);

        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.edit",[
                'objeto' => $returnFromFunction,
                'informacoesComunsFront' => $this->labelsCommomFrontEnd()
            ]);
        }
    }
}