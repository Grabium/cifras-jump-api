<?php

namespace App\Service\Analise\Matched;

class DiminutoMatched extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->quinta->set($valor);
    }
}
