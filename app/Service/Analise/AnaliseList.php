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
            //"#"=>"SustenidoAnalise",
            //"b"=>"BemolAnalise",
            "m"=>"MenorAnalise",
            "d"=>"DimAnalise",
            "/"=>"BarraAnalise",
            "#"=>"IntervaloAnalise",
            "b"=>"IntervaloAnalise",
            "2"=>"IntervaloAnalise",
            "3"=>"IntervaloAnalise",
            "4"=>"IntervaloAnalise",
            "5"=>"IntervaloAnalise",
            "6"=>"IntervaloAnalise",
            "7"=>"IntervaloAnalise",
            "9"=>"IntervaloAnalise",

            "1"=>"IntervaloAnalise",
            "+"=>"IntervaloAnalise",
            "-"=>"IntervaloAnalise",
            "8"=>"IntervaloAnalise",
            "0"=>"IntervaloAnalise",
        ];
    }
}
