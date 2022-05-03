<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidade::create([ 
            'nome' => 'UNIDADE', 
            'sigla' => 'UN'
        ]);

        Unidade::create([ 
            'nome' => 'KILO', 
            'sigla' => 'KG'
        ]);

        Unidade::create([ 
            'nome' => 'METRO', 
            'sigla' => 'MT'
        ]);

        Unidade::create([ 
            'nome' => 'LITRO', 
            'sigla' => 'LT'
        ]);
    }
}
