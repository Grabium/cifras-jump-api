<?php


namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;

class NegativoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {
        echo '<h2>[Resultado] "'.$acorde->cifraOriginal->sinal.'" NÃO é acorde.</h2>'.PHP_EOL;
    }
}
