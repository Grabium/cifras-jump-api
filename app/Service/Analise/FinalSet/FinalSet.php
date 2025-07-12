<?php

namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;

abstract class FinalSet
{
    abstract public function deduce(Acorde $acorde);
}
