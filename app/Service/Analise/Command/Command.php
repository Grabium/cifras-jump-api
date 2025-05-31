<?php

namespace App\Service\Analise\Command;

use App\Entidade\Acorde\Acorde;

abstract class Command
{
  
  public int $key;
  public Acorde $acorde;

  public function __construct(int $key, Acorde $acorde)
  {
    $this->key = $key;
    $this->acorde = $acorde;
  }

  public function getCaractere($key = null)
  {
    if($key == null){
      $key = $this->key;
    }
    
    return $this->acorde->cifraOriginal->sinal[$key];
  }

  abstract public function analisar();
}
