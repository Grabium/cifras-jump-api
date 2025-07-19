<?php

namespace App\Service\Analise;

class AnaliseList
{
    /**
     * Fornece a lista de classes Analise e seus gatilhos nos indices.
     */
    public function get()
    {
        return[
            "A"=>"TomAnalise",
            "B"=>"TomAnalise",
            "C"=>"TomAnalise",
            "D"=>"TomAnalise",
            "E"=>"TomAnalise",
            "F"=>"TomAnalise",
            "G"=>"TomAnalise",
            " "=>"SpaceAnalise",
            "#"=>"SustenidoAnalise",
            "b"=>"BemolAnalise",
            "m"=>"MenorAnalise",
            "d"=>"DimAnalise",
            "/"=>"BarraAnalise",
        ];
    }
}
