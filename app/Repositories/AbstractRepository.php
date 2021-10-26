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

    public function allObject()
    {
        try
        {
            return $this->model::all();
        }
        catch(\Exception $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }catch(QueryException $e)
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
        }catch(QueryException $e)
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
        }catch(QueryException $e)
        {
            \Log::error('Error '.$e->getMessage());
            return false;
        }   
    }
}