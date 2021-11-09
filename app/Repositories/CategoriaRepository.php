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
        $personalization['informative_search'] = "Pesquise digitando o nome da categoria desejada";
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
            $result = ['data'=> $returnFromFunction, 'message' =>'Registros carregados com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível carregar os registros do banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }
        
        /*
        **analisar se a condição de status vai permanecer
        **pois nada muda praticamente
        */
        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result, 
                'qtdRegisters' => 10,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result, 
                'qtdRegisters' => 0,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ])->withErrors($result['message']);
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
            $dataTrated = $this->model->tratament($request->all());
            $returnFromFunction = $this->createObject($dataTrated);

            if($returnFromFunction)
            {
                $result = ['data'=> $returnFromFunction, 'message' =>'Registros carregados com sucesso.', 'errors'=> null];
                $status = 200;
            }
            else
            {
                $result = ['data'=> null, 'message' =>'Não foi possivel salvar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
                $status = 400;
            }

            if(env('FRONTEND_BLADE') && $status == 200)
            {
                return redirect()
                       ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
            }
            elseif(env('FRONTEND_BLADE') && $status == 400)
            {
                return redirect()
                       ->back()
                       ->withErrors($result['message']);
            } 
            elseif(!env('FRONTEND_BLADE'))
            {
                return response()->json($result, $status);
            }
        }
        else
        {
            return response()->json(['data'=> null, 'message' => $validation, 'errors'=> true], 201);//$result e $status
        }
    }

    public function show($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->findObject($request->id);
        
        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registro detalhado com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível carregar os detalhes do registro. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }          

        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
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
            $dataTrated = $this->model->tratament($request->all());
            $returnFromFunction = $this->createObject($dataTrated);

            if($returnFromFunction)
            {
                $result = ['data'=> $returnFromFunction, 'message' =>'Registros carregados com sucesso.', 'errors'=> null];
                $status = 200;
            }
            else
            {
                $result = ['data'=> null, 'message' =>'Não foi possivel salvar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
                $status = 400;
            }

            if(env('FRONTEND_BLADE') && $status == 200)
            {
                return redirect()
                       ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
            }
            elseif(env('FRONTEND_BLADE') && $status == 400)
            {
                return redirect()
                       ->back()
                       ->withErrors($result['message']);
            } 
            elseif(!env('FRONTEND_BLADE'))
            {
                return response()->json($result, $status);
            }
        }
        else
        {
            return response()->json(['data'=> null, 'message' => $validation, 'errors'=> true], 201);//$result e $status
        }
    }

    public function delete($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->deleteObject($request->id);
        
        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registro excluído com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível excluir o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }          

        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
        }
    }

    public function inactiveOrActive($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->inactiveOrActiveObject($request->id);
        
        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registro inativado ou ativado com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível inativar ou ativar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }          

        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
        }
    }

    public function replicate($request)
    {
        $result;
        $status;
        $returnFromFunction = $replicateObject($request->id);
        
        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registro clonado com sucesso.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível clonar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }          

        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
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
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
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
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
    }
}