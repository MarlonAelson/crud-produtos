<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([ 
            'identification'     => 'sispem',
            'frontend'    => 'blade',
            'type_application_navigator' => 'web',
            'bd_database' => 'sispem',
            'bd_hostname' => 'localhost',
            'bd_username' => 'root',
            'bd_password' => '769SUPORTESEGURO',
            'bd_drive' => 'mysql',
            'bd_port' => '3306',
            'bd_create'    => 'S'
        ]);
    }
}