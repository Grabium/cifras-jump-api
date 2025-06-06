<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\Enarmonia;
use App\Service\Analise\Matcheds\TomFundamental;

class Sustenido extends Command
{
    public function analisar()
    {
        if($this->key != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo em SustenidoCommand'.PHP_EOL;
        }

        (new Enarmonia($this->indice, $this->acorde, $this->key))->handle($this->caractere);
        (new TomFundamental($this->indice, $this->acorde, $this->key))->handle('');
    }
}
