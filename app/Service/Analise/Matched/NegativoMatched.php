<?php

namespace App\Service\Analise\Matched;

class NegativoMatched extends Matched
{
    public function handle(mixed $valor = null)
    {
        echo '[Resultado] "'.$this->acorde->cifraOriginal->sinal.'" NÃO é acorde.'.PHP_EOL;
    }
}
