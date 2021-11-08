<?php
namespace App\Repositories;

use Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository
{
    protected $model;

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
        //DB::beginTransaction();
        try
        {
            return $this->model::create($data);
            //DB::commit();
        }
        catch(\Exception $e)
        {
            //DB::rollBack();
            \Log::error('Error '.$e->getMessage());
            return false;
        }
        catch(QueryException $e)
        {
            //DB::rollBack();
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
            $objectFind = $this->model::findOrFail($id);
    
            return $this->model->update($data);
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

            $objectFind->ativo = $objectFind->ativo == "SIM" ? "NAO":"SIM";

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
            $newObjetc = $this->model::findOrFail($id)->replicate();
            $newObjetc->nome = $newObjetc->nome . ' - COPIA';
            return $newObjetc->save();    
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
}