<?php

namespace App\Service\Analise\Matcheds;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;

class Negativo extends Matched
{
    public function handle()
    {
        echo '[Resultado] "'.$this->acorde->cifraOriginal->sinal.'" NÂO é acorde.'.PHP_EOL;
    }
}
