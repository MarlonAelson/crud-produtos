<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $table = 'pessoas';
    protected $guarded = ['id'];
    //necessário para o softdelete
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'nome_alternativo',
        'empresa',
        'cliente',
        'fornecedor',
        'colaborador',
        'outros',
        'password',
        'acessa_sistema',
        'ativo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    private $rulesValidation = [
		//'nome'	                        => ['required', 'string', 'max:45', "unique:categorias, nome, {ignore()}, id"],
        //'nome'	                        => ['required', 'string', 'max:45'],
        //'categoria_pessoa'              => ['required', 'string', 'max:1'],
        //'categoria_produto_servico'     => ['required', 'string', 'max:1'],
        //'categoria_objeto_manutencao'   => ['required', 'string', 'max:1'],
		//'ativo'                         => ['required', 'string', 'max:1'],
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
        if(empty($data['categoria_pessoa']))
            $data['categoria_pessoa'] = 'S';
            
        if(empty($data['categoria_produto_servico']))
            $data['categoria_produto_servico'] = 'S';
        
        if(empty($data['categoria_objeto_manutencao']))
            $data['categoria_objeto_manutencao'] = 'S';
        
        if(empty($data['ativo']))
            $data['ativo'] = 'S';

        return $data;
    }

    public function pessoasEmails()
    {
        return $this->hasMany(PessoaEmails::class);
    }

    public function permissoes()
	{
		return $this->belongsToMany(Permissao::class, 'model_has_permissions', 'model_id', 'permission_id');
	}

}
