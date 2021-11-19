<?php
namespace App\Repositories;

use Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Services\Pdf\Pdf;
use App\Services\Mail\Email;

use App\Models\Pessoa;

abstract class AbstractRepository
{
    protected $model;
    protected $relationShip = [];
    protected $hasComplements = false;

    public function __construct()
    {
    }

    //Método responsável por recuperar todos os objetos
    public function allObject($params = null)
    {
        try
        {
            return $this->model::all();
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por criar um objeto um objeto
    public function createObject($data)
    {
        DB::beginTransaction();
        try
        {
            $object = $this->model::create($data);
            if(count($this->relationShip)){
                
                for($i = 0; $i < count($this->relationShip); $i++){
                    switch($this->relationShip[$i]){
                        case $this->relationShip[$i][0] == 'OneToOne':
                            $method = $this->relationShip[$i][1];
                            $object->$method()->attach($data[$this->relationShip[$i][1]]);
                            break;
                        case $this->relationShip[$i][0] == 'OneToMany':
                            $method = $this->relationShip[$i][1];
                            $object->$method()->attach($data[$this->relationShip[$i][1]]);
                            break;
                        case $this->relationShip[$i][0] == 'ManToMany':
                            $method = $this->relationShip[$i][1];
                            $object->$method()->attach($data[$this->relationShip[$i][1]]);
                            break;
                    }
                }   
            }
            DB::commit();
            return $object;
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            DB::rollBack();
            \Log::error('Error '.$e->getMessage());
            return false;
        }   
    }

    //Método responsável por buscar um objeto um objeto
    public function findObject($id)
    {
        try
        {
            /*
            ** caso id não exista irá cair no catch. se usasse o método find dá 
            ** problema informando que não pode deletar um dado null e não caía no catch
            */
            return $this->model::findOrFail($id);       
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por salvar as alterações de um objeto
    public function updateObject($id, $data)
    {
        try
        {
            return $this->model::findOrFail($id)->update($data);
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }   
    }
    //Método responsável por ativar ou inativar um objeto
    public function inactiveOrActiveObject($id)
    {

        try
        {
            /*
            ** caso id não exista irá cair no catch. se usasse o método find dá 
            ** problema informando que não pode deletar um dado null e não caía no catch
            */
            $objectFind = $this->model::findOrFail($id);

            $objectFind->ativo = $objectFind->ativo == "S" ? "N":"S";

            return $objectFind->save();

        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por deletar um objeto usando softdelete do laravel
    public function deleteObject($id)
    {
        try
        {
            /*
            ** caso id não exista irá cair no catch. se usasse o método find dá 
            ** problema informando que não pode deletar um dado null e não caía no catch
            */
            return $this->model::findOrFail($id)->delete();       
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por clonar um objeto
    public function replicateObject($id)
    {
        try
        {
            /*
            ** caso id não exista irá cair no catch. se usasse o método find dá 
            ** problema informando que não pode deletar um dado null e não caía no catch
            */
            $objectNew = $this->model::findOrFail($id)->replicate();
            
            //colocado esses campos apenas para ficar como exemplos de possibilidades
            if(isset($objectNew->nome))
                $objectNew->nome = $objectNew->nome . ' - COPIA';

            if(isset($objectNew->estoque))
                $objectNew->estoque = 0;
            
            if(isset($objectNew->preco))
                $objectNew->preco = 0;

            return $objectNew->save();    
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por gerar o pdf dos objetos
    public function pdfObjects()
    {
        try
        {
            return Pdf::generatePDF();    
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por enviar os objetos do sistema por e-mail
    public function emailsObjects()
    {
        $id = 1;
        $pessoa = Pessoa::where('id', $id)->first();
        try
        {
            return Mail::to('marlon@ar-consultoria.com')
                  //->cc('') //email para receber a cópia
                  //->bcc()  //email para receber a cópia oculta
                  ->send(new Email($pessoa)); 
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }
    }

    //Método responsável por recuperar o ID da empresa selecionada para se trabalhar
    public function getCompanyId(){
        return session()->get('empresa_id');
    }

    //Método responsável por recuperar o ID do usuário logado.
    public function getUserId(){
        $user = Auth::guard()->user();
        return $user->id ? : 0;
    }
}