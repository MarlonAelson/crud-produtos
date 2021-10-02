<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
	use HasFactory;

	protected $table = 'tenants';

	protected $hidden = [
		'bd_password'
	];

	protected $fillable = [
		'pessoa_id',
		'identification',
		'bd_database',
		'bd_hostname',
		'bd_username',
		'bd_password',
		'bd_drive',
		'bd_port'
	];
}
