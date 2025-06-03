<?php

namespace App\Service\Analise\Matcheds;

class Negativo extends Matched
{
    public function handle()
    {
        echo '[Resultado] "'.$this->acorde->cifraOriginal->sinal.'" NÃO é acorde.'.PHP_EOL;
    }
}
