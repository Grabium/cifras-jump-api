<?php

namespace App\Service\Entidade\Texto;

class Texto
{
    public string $textoOriginal;
    public string $textoFinal;
    
    public function __construct(string $texto)
    {
        $this->textoOriginal = ' '.$texto.' ';
    }
}
