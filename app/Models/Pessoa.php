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
        'categoria_id',
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

    protected $with = [
        'emails',
        'enderecos',
        'permissoes'        
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
        //'categoria_id'                => ['required', 'string', 'min:1', 'max:9223372036854775807'],
        //'categoria_produto_servico'       => ['required', 'string', 'max:1'],
        //'categoria_objeto_manutencao'     => ['required', 'string', 'max:1'],
		//'ativo'                           => ['required', 'string', 'max:1'],
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

    public function search($paramsSearch)
    {
        $where = '';
        $dataComplet  = '';

        if($paramsSearch['search'] == 'simple')
        {
            $condition = $paramsSearch['filters']["textoBusca"] 
                        || $paramsSearch['filters']["textoBusca"] == 0 
                        ? $paramsSearch['filters']["textoBusca"] : '%' ;

            $where = "
            (
                {$this->table}.nome like '{$condition}%'
                OR {$this->table}.nome like '{$condition}%'
            )   AND {$this->table}.ativo IN ('{$paramsSearch['filters']['ativo']}')";

        }
        elseif($paramsSearch['search'] == 'advanced')
        {
            $where  = isset($paramsSearch['filters']['nomes']) && (!empty($paramsSearch['filters']['nomes']) || $paramsSearch['filters']['nomes'] == 0) 
            ? " ({$this->table}.nome like '{$paramsSearch['filters']['nomes']}%' OR {$this->table}.nome_alternativo like '{$paramsSearch['filters']['nomes']}%')" 
            : " {$this->table}.nome like '%' ";

            $where .= " AND {$this->table}.ativo IN ('{$paramsSearch['filters']['ativo']}')";
        }

        if($where)
        {
            $dataComplet = Pessoa::whereRaw($where)
                                    //->join()
                                    ->offset($paramsSearch['quantity'])
                                    ->limit($paramsSearch['paginate'])
                                    ->orderByRaw("{$paramsSearch['orderByColunm']} {$paramsSearch['orderByType']}")
                                    ->paginate();
        }
                  
        return $dataComplet;
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function permissoes()
	{
		return $this->belongsToMany(Permissao::class, 'model_has_permissions', 'model_id', 'permission_id')->withPivot('model_type');
	}

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'pessoa_id');
    }

    /*
    ** Método responsável por retornar os relacionamentos do model
    ** contendo o tipo do relacionamento. Ex. OneToOne, OneToMany e ManToMany
    */
    public function relationShipsPossibles()
    {
        return  [
                    ['ManToMany', 'permissoes'],
                    ['OneToMany', 'enderecos'],
                    ['OneToMany', 'emails'],
                ];
    }

    /*public function complementAfterRegisteredInDatabase()
    {
        Devido a está utilizando os métodos padrões dos models de permissao/permission
        foi desativado colocado na migration um valor defautl para a coluna model_type,
        por isso esse método está comentado já que o mesmo iria ser utilizado para atualizar 
        esse campo. O valor default está vindo do diretório config/permission.php array 'columns_values_defaults'
        e índice 'model_type'. No entanto, esse permanece de idéia para os próximos projetos ou próximas necessidades.
    }*/
}
