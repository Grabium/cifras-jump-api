<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\FinalMatch\PositivoFinalMatch;

class SpaceCommand extends Command
{
    /*****
   * @param void
   * @return bool - true (chama o próximo acode). false (continua analisando o acorde).
   ******/
    public function analisar():bool
    {
        (new PositivoFinalMatch($this->indice, $this->acorde))->deduce();
        return true;
    }
}
