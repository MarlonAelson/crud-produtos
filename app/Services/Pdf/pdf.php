<?php
namespace App\Services\Pdf;

class Pdf 
{
    public static function generatePDF()
    {
        $teste = [];
        return \PDF::loadView('categorias.pdf', $teste)
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->download('nome-arquivo-pdf-gerado.pdf');
    }    
}