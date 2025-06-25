<?php

namespace App\Service\Entidade\Texto;

class Texto
{
    public string $textoOriginal;
    public string $textoFinal;
    
    public function __construct(string $texto)
    {
        $caracteres = ['°', 'º'];
        $marcadores = ['dim', 'dim'];
        $texto = str_replace($caracteres, $marcadores, $texto);

        $this->textoOriginal = ' '.$texto.' ';
    }
}
