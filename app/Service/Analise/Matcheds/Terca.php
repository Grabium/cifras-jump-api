<?php

namespace App\Service\Analise\Matcheds;

class Terca extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->terca->set($valor);
    }
}
