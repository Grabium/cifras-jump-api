<?php

namespace App\Service\Analise\Flag;

class Flag
{
  private bool $status;
  
  public function __construct()
  {
    $this->fechar();
  }
  
  public function status():bool
  {
    return $this->status;
  }
  
  public function abrir()
  {
    $this->status = true;
  }
  
  public function fechar()
  {
    $this->status = false;
  }
}
