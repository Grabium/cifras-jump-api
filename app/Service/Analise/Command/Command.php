<?php

namespace App\Service\Analise\Command;

use App\Entidade\Acorde\Acorde;

abstract class Command
{
  
  public int $key;
  public Acorde $acorde;
  public string $caractere;

  public function __construct(int $key, Acorde $acorde)
  {
    $this->key = $key;
    $this->acorde = $acorde;
    $this->setCaractere($key);
  }

  public function setCaractere(int $key)
  {
    if($key == null){
      $key = $this->key;
    }
    
    $this-> caractere = $this->acorde->cifraOriginal->sinal[$key];
  }

  abstract public function analisar();
}
