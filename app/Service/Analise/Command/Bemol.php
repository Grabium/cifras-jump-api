<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\TomFundamental;

class Bemol extends Command
{
    public function analisar()
    {
        if($this->key != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo'.PHP_EOL;
        }

        (new TomFundamental($this->indice, $this->acorde, $this->key))->handle();
    }
}
