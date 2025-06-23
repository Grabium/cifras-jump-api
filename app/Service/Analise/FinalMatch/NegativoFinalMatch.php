<?php

namespace App\Service\Analise\FinalMatch;

//use App\Service\Entidade\Aprovados\AprovadosQueue;

class NegativoFinalMatch extends FinalMatch
{
    public function deduce()
    {
        echo '[Resultado] "'.$this->acorde->cifraOriginal->sinal.'" NÃO é acorde.'.PHP_EOL;
    }
}
