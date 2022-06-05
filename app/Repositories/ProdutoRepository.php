<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Models\Unidade;

class ProdutoRepository extends AbstractRepository
{
    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    public function labelsCommomFrontEnd()
    {
        $personalization['informative_search'] = "Pesquise digitando o nome do produto desejada";
        $personalization['label_card_form'] = "Cadastrar Produto";
        $personalization['label_card_edit'] = "Alterar Produto";
        $personalization['label_card_list'] = "Consultar Produtos";
        $personalization['route_name_view'] = "produtos";

        return $personalization;
    }

    public function all($request = null)
    {
        $result;
        $status;
        $returnFromFunction = $this->allObject($request);

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
        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result,
                'qtdRegisters' => 10,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result,
                'qtdRegisters' => 0,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ])->withErrors($result['message']);
        }
        elseif(!env('FRONTEND') == 'blade')
        {
            return response()->json($result, $status);
        }
    }

    public function search($request)
    {
        $result;
        $status;
        $returnFromFunction = $this->searchObject($request);
    
        if($returnFromFunction)
        {
            $result = ['data'=> $returnFromFunction, 'message' =>'Registros carregados com sucesso.', 'errors'=> null];
            $status = 200;
            session()->put('result_pdf', $result['data']);
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
        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result,
                'qtdRegisters' => 10,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.list",[
                'objects' => $result,
                'qtdRegisters' => 0,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ])->withErrors($result['message']);
        }
        elseif(!env('FRONTEND') == 'blade')
        {
            return response()->json($result, $status);
        }
    }

    public function store($request)
    {
        $result;
        $status;
        $validation;

        if(env('FRONTEND') == 'blade')
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

            if(env('FRONTEND') == 'blade' && $status == 200)
            {
                return redirect()
                       ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
            }
            elseif(env('FRONTEND') == 'blade' && $status == 400)
            {
                return redirect()
                       ->back()
                       ->withErrors($result['message']);
            }
            elseif(!env('FRONTEND') == 'blade')
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

        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND') == 'blade')
        {
            return response()->json($result, $status);
        }
    }

    public function update($request)
    {
        $result;
        $status;
        $validation;

        if(env('FRONTEND') == 'blade')
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

            if(env('FRONTEND') == 'blade' && $status == 200)
            {
                return redirect()
                       ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
            }
            elseif(env('FRONTEND') == 'blade' && $status == 400)
            {
                return redirect()
                       ->back()
                       ->withErrors($result['message']);
            }
            elseif(!env('FRONTEND') == 'blade')
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

        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND') == 'blade')
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

        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND') == 'blade')
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

        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return redirect()->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index");
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return redirect()
                    ->route("{$this->labelsCommomFrontEnd()['route_name_view']}.index")
                    ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND') == 'blade')
        {
            return response()->json($result, $status);
        }
    }

    public function pdf()
    {
        $view = "{$this->labelsCommomFrontEnd()['route_name_view']}.pdf";
        $objects = session()->get('result_pdf');
        return $this->pdfObjects($view, $objects);
    }

    public function excel()
    {
        $objects = session()->get('result_pdf');
        return $this->excelObjects($view, $objects);
    }

    public function email()
    {
        dd($this->emailsObjects());
    }

    /**
     * Os Métodos abaixos: create e edit - são específicos para quando o projeto for com blade
     */
    public function create($request)
    {
        $unidades = Unidade::all();

        if(env('FRONTEND') == 'blade')
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.form",[
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd(),
                'unidades' => $unidades
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

        if(env('FRONTEND') == 'blade' && $status == 200)
        {
            return view("{$this->labelsCommomFrontEnd()['route_name_view']}.edit",[
                'object' => $returnFromFunction,
                'informationsCommonFrontEnd' => $this->labelsCommomFrontEnd()
            ]);
        }
        elseif(env('FRONTEND') == 'blade' && $status == 400)
        {
            return redirect()
                       ->back()
                       ->withErrors($result['message']);
            //return redirect()->to('/categorias/listagem')->withErrors(['message'=>'this is first message']);
        }
        elseif(!env('FRONTEND') == 'blade')
        {
            return response()->json($result, $status);
        }
    }
}
