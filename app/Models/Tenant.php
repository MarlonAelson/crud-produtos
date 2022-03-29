<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'tenants';
	protected $guarded = ['id'];
	//necessário para o softdelete
    protected $dates = ['deleted_at'];

	protected $hidden = [
		'bd_password'
	];

	protected $fillable = [
		'pessoa_id',
		'identification',
		'frontend',
		'type_application_navigator',
		'bd_database',
		'bd_hostname',
		'bd_username',
		'bd_password',
		'bd_drive',
		'bd_port',
		'bd_create'
	];
}
