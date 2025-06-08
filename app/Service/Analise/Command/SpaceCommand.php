<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\PositivoMatched;

class SpaceCommand extends Command
{
    /*****
   * @param void
   * @return bool - true (chama o próximo acode). false (continua analisando o acorde).
   ******/
    public function analisar():bool
    {
        (new PositivoMatched($this->indice, $this->acorde, $this->key))->handle();
        return true;
    }
}
