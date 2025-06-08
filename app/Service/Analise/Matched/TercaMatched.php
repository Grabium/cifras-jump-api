<?php

namespace App\Service\Analise\Matched;

class TercaMatched extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->terca->set($valor);
    }
}
