<?php

namespace App\Service\Analise\Matcheds;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;

class Negativo
{
    public function handle(string $indice, Acorde $acorde)
    {
        echo '[Resultado] "'.$acorde->cifraOriginal->sinal.'" NÂO é acorde.'.PHP_EOL;
        unset(CifrasQueue::getAcordes()[$indice]);
    }
}
