<?php

namespace App\Service\Analise\Matcheds;

class Enarmonia extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->enarmonia->set($valor);
    }
}
