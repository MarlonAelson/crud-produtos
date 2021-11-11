<?php
namespace App\Repositories;

use Log;
use Illuminate\Database\QueryException;
use App\Services\Pdf\Pdf;
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
}