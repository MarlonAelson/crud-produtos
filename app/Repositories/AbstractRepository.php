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

    public function findObject($id)
    {
        try
        {
            return $this->model::find($id);
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

    public function updateObject($id, $data)
    {
        try
        {
            $objectFind = $this->model::find($id);
            /*if(!$obj){//testar depois
                throw new \Exception("Nenhum registro encontrado com o ID {$id}");
            }*/
    
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

    public function inactiveOrActiveObject($id)
    {

        try
        {
            /*
            ** caso id não exista irá cair no catch. se usasse o método find dá 
            ** problema informando que não pode deletar um dado null e não caía no catch
            */
            $objectFind = $this->model::findOrFail($id);

            $objectFind->ativo = $objectFind->ativo == "1" ? "0":"1";

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

    public function showObject($id)
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
}