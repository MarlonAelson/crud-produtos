<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

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
        'emitente_id',
        'destinatario_id',
        'numero',
        'situacao'
    ];

    private $rulesValidation = [
		
	];

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

    public function emitente()
    {
        return $this->hasOne(Pessoa::class, 'emitente_id');
    }

    public function destinatario()
    {
        return $this->hasOne(Pessoa::class, 'destinatario_id');
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class, 'pedido_id');
    }    

    /*
    ** Método responsável por retornar os relacionamentos do model
    ** contendo o tipo do relacionamento. Ex. OneToOne, OneToMany e ManToMany
    */
    public function relationShipsPossibles()
    {
        return  [
                    ['OneToMany', 'itens']
                ];
    }
}
