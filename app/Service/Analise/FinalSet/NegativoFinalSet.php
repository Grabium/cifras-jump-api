<?php


namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Logs\LogReprovacao;

class NegativoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {
        //echo LogReprovacao::getMessage(true);
    }
}
