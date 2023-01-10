<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    private $search = 'simple';
    private $textSearch = '%';
    private $active = 'S';
    private $offset = '0';
    private $paginate = 15;
    private $orderByColunm = 'nome';
    private $orderByType = 'asc';

    protected $table = 'produtos';
    protected $guarded = ['id'];
    //necessário para o softdelete
    protected $dates = ['deleted_at'];
    /**
     * Caso queira mudar o nome dos campos de deleted_at, created_at e updated_at
     * 
     * const DELETED_AT = 'is_deleted';
     * const CREATED_AT = 'creation_date';
     * const UPDATED_AT = 'updated_date';
     * 
     */

    protected $fillable = [
        'codigo_barras',
        'nome',
        'unidade_id',
        'ativo'
    ];

    private $rulesValidation = [
        'codigo_barra'	                => ['nullable', 'string',  'max:14'],
        'nome'	                        => ['required', 'string',  'max:45'],
        'unidade_id'                    => ['required', 'integer', 'max:999999999'],
		'ativo'                         => ['required', 'string',  'max:1'],
	];

    /*
    ** M 
    */
	public function validator($data = null)
    {
        if($data)
        {   
            $validator = Validator::make($data, $this->rulesValidation);

            if($validator->passes())
            {
                return true;
            }else{
                return $validator->errors();
            }
        }
        else
        {
            return $this->rulesValidation;
        }
    }

    /*
    ** Metódo para realizar tratamento de campos
    ** Após passar pelo validator
    */ 
    public function tratament($data)
    {
        if(empty($data['codigo_barras']))
            $data['codigo_barras'] = '0';
            
        return $data;
    }

    // Relacionamentos
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function search($paramsSearch)
    {
        $where = '';
        $dataComplet  = '';

        $search         = $paramsSearch['search'] ? $paramsSearch['search'] : $this->search;
        $textSearch     = isset($paramsSearch['filters']['textSearch']) ? $paramsSearch['filters']['textSearch'] : $this->textSearch;
        $active         = isset($paramsSearch['filters']['ativo']) ? $paramsSearch['filters']['ativo'] : $this->active;
        $offset         = $paramsSearch['offset'] || $paramsSearch['offset'] == 0 ? $paramsSearch['offset'] : $this->offset;
        $paginate       = $paramsSearch['paginate'] ? $paramsSearch['paginate'] : $this->paginate;
        $orderByColunm  = $paramsSearch['orderByColunm'] ? $paramsSearch['orderByColunm'] : $this->orderByColunm;
        $orderByType    = $paramsSearch['orderByType'] ? $paramsSearch['orderByType'] : $this->orderByType;

        if($search == 'simple')
        {
            $where = "
            (
                    {$this->table}.nome LIKE '%{$textSearch}%'
                 OR {$this->table}.codigo_barras LIKE '%{$textSearch}%'
            )   AND {$this->table}.ativo IN ('{$active}')";

        }
        elseif($search == 'advanced')
        {
            //aqui é para buscas avançadas
        }

        if($where)
        {
            $dataComplet = Produto::whereRaw($where)
                                    //->join()
                                    ->offset($offset)
                                    ->limit($paginate)
                                    ->orderByRaw("{$orderByColunm} {$orderByType}")
                                    ->paginate($paginate);
        }
                  
        return $dataComplet;
    }
    
}
