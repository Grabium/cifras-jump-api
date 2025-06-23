<?php

namespace App\Service\Analise\FinalMatch;

use App\Service\Entidade\Acorde\Acorde;

abstract class FinalMatch
{

    public int $indice;//referente ao CifrasQueue->acordes
    public Acorde $acorde;

    public function __construct(int $indice, Acorde $acorde)
    {
        $this->indice = $indice;
        $this->acorde = $acorde;
    }

    abstract public function deduce();
}
