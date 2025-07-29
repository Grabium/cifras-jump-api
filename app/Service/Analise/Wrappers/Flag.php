<?php

namespace App\Service\Analise\Wrappers;

use App\Service\Analise\Wrappers\Flag\BarraFlag;
use App\Service\Analise\Wrappers\Flag\ParentesisFlag;
use App\Service\Analise\Wrappers\Flag\PossivelIntervaloCompostoFlag;

class Flag
{
  public BarraFlag $barra;
  public ParentesisFlag $parentesis;
  public PossivelIntervaloCompostoFlag $possivelIntervaloComposto;

  public function flagFactory()
  {
    $this->barra = new BarraFlag();
    $this->parentesis = new ParentesisFlag();
    $this->possivelIntervaloComposto = new PossivelIntervaloCompostoFlag();

    return $this;
  }  
}