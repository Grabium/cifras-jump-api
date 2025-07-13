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
            "A"=>"TomCommand",
            "B"=>"TomCommand",
            "C"=>"TomCommand",
            "D"=>"TomCommand",
            "E"=>"TomCommand",
            "F"=>"TomCommand",
            "G"=>"TomCommand",
            " "=>"SpaceCommand",
            "#"=>"SustenidoCommand",
            "b"=>"BemolCommand",
            "m"=>"MenorCommand",
            "d"=>"DimCommand",
            "/"=>"BarraCommand",
        ];
    }
}
