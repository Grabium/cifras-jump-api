<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\Positivo;

class Space extends Command
{
    public function analisar():bool
    {
        (new Positivo($this->indice, $this->acorde, $this->key))->handle();
        return true;
    }
}
