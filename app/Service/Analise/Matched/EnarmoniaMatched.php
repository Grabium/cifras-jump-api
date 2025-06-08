<?php

namespace App\Service\Analise\Matched;

class EnarmoniaMatched extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->enarmonia->set($valor);
    }
}
