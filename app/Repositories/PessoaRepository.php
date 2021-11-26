<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Pessoa;
use App\Models\Permissao;

class PessoaRepository extends AbstractRepository
{
    public function __construct(Pessoa $model)
    {
        $this->model = $model;
        $this->relationShip = $this->model->relationShipsPossibles();
    }

    public function labelsCommomFrontEnd()
    {
        $personalization['informative_search'] = "Pesquise digitando o ... desejada";
        $personalization['label_card_form'] = "Cadastrar Pessoa";
        $personalization['label_card_edit'] = "Alterar Pessoa";
        $personalization['label_card_list'] = "Consultar Pessoas";
        $personalization['route_name_view'] = "pessoas";
        
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
                $result = ['data'=> $returnFromFunction, 'message' =>'Registro salvo com sucesso.', 'errors'=> null];
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
            $returnFromFunction = $this->updateObject($request->id, $dataTrated);
      
            if($returnFromFunction)
            {
                $result = ['data'=> $returnFromFunction, 'message' =>'Registro alterado com sucesso.', 'errors'=> null];
                $status = 200;
            }
            else
            {
                $result = ['data'=> null, 'message' =>'Não foi possivel alterar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
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
        $returnFromFunction = $this->replicateObject($request->id);
        
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

    public function pdf()
    {
        return $this->pdfObjects();
    }

    public function email()
    {
        dd($this->emailsObjects());
    }

    //Método responsável por retornar as empresas cadastradas no banco de dados
    public static function getCompanies()
    {
        //model, campos, wheres (condicoes)
        return Pessoa::select('id', 'nome', 'nome_alternativo',)->where('empresa', 'S')->where('ativo', 'S')->get();
    }

    /**
     * Os Métodos abaixos: create e edit - são específicos para quando o projeto for com blade
     */
    public function create($request)
    {
        $permissoes = Permissao::all();
        if(env('FRONTEND_BLADE'))
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.form",[
                'permissoes' => $permissoes,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
    }

    public function edit($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->findObject($request->id);

        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registro carregado com sucesso para poder ser alterado.', 'errors'=> null];
            $status = 200;
        }
        else
        {
            $result = ['data'=> null, 'message' =>'Não foi possível alterar o registro no banco de dados. Saia da tela e entre nela novamente para tentar mais uma vez. Caso o problema continue entre em contato com o suporte do sistema.', 'errors'=> true];
            $status = 400;
        }

        if(env('FRONTEND_BLADE') && $status == 200)
        {   
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.edit",[
                'object' => $returnFromFunction,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif(env('FRONTEND_BLADE') && $status == 400)
        {
            return redirect()
                       ->back()
                       ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND_BLADE'))
        {
            return response()->json($result, $status);
        }
    }
}