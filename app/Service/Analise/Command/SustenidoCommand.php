<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\EnarmoniaMatched;
use App\Service\Analise\Matched\TomFundamentalMatched;

class SustenidoCommand extends Command
{
    /*****
   * @param void
   * @return bool - true (chama o próximo acode). false (continua analisando o acorde).
   ******/
    public function analisar(): bool
    {
        if($this->key != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo em SustenidoCommand'.PHP_EOL;
        }

        (new EnarmoniaMatched($this->indice, $this->acorde, $this->key))->handle($this->caractere);
        (new TomFundamentalMatched($this->indice, $this->acorde, $this->key))->handle('');

        return false;
    }
}
