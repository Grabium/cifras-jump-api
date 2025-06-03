<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\TomFundamental;

class Sustenido extends Command
{
    public function analisar()
    {
        if($this->key != 1){
            //processar intervalo
        }

        (new TomFundamental($this->indice, $this->acorde, $this->key))->handle();
    }
}
