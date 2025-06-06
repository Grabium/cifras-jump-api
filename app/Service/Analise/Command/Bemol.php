<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\TomFundamental;
use App\Service\Analise\Matcheds\Enarmonia;

class Bemol extends Command
{
    public function analisar()
    {
        if($this->key != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo em BemolCommand'.PHP_EOL;
        }

        (new Enarmonia($this->indice, $this->acorde, $this->key))->handle($this->caractere);
        (new TomFundamental($this->indice, $this->acorde, $this->key))->handle('');
    }
}
