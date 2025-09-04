<?php


namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Detail\RejectDetail;

class NegativoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {
        //echo LogReprovacao::getMessage(true);
    }
}
