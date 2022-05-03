<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ProdutoExport implements FromCollection, Responsable
{
    use Exportable;
    
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'invoices.csv';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::CSV;
    
    /**
    * Optional headers
    */
    /*private $headers = [
        'Content-Type' => 'text/csv',
    ];*/

    public function collection()
    {
        return Produto::all();
    }
}
