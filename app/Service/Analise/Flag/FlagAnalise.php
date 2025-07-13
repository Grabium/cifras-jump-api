<?php

namespace App\Service\Analise\Flag;

class FlagAnalise
{
  public BarraFlag $barra;
  public ParentesisFlag $parentesis;
  public PossivelIntervaloCompostoFlag $possivelIntervaloComposto;

  public function __construct()
  {
    $this->barra = new BarraFlag();
    $this->parentesis = new ParentesisFlag();
    $this->possivelIntervaloComposto = new PossivelIntervaloCompostoFlag();
  }
  
}