<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pessoas_emails';
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
        'pessoa_id',
        'email'
    ];

    private $rulesValidation = [
        'pessoa_id'         => ['required', 'integer', 'min:1'],
        'email'             => ['required', 'string', 'max:60'],
	];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

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

    public function tratament($data)
    {
        return $data;
    }    
}
