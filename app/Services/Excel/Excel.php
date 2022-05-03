<?php
namespace App\Services\Pdf;

class Excel 
{
    public static function generateExcel($view, $data)
    {
        return \PDF::loadView($view, ['objects' => $data])
                    // Se quiser que fique no formato a4 retrato: 
                    ->setPaper('a4', 'landscape')
                //->download('nome-arquivo-pdf-gerado.pdf');
                ->stream('nome-arquivo-pdf-gerado.pdf');
    }    
}