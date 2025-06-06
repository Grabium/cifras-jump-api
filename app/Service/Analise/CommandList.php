<?php

namespace App\Service\Analise;

class CommandList
{
    /**
     * Fornece a lista de classes Command e seus gatilhos nos indices.
     */
    public function get()
    {
        return[
            'A'=>'Tom',
            'B'=>'Tom',
            'C'=>'Tom',
            'D'=>'Tom',
            'E'=>'Tom',
            'F'=>'Tom',
            'G'=>'Tom',
            ' '=>'Space',
            '#'=>'Sustenido',
            'b'=>'Bemol',
            'm'=>'Menor'
        ];
    }
}
