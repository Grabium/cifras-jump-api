<?php

namespace App\Service\Analise\Command;

use App\Entidade\Acorde\Acorde;

abstract class Command
{
  public int $indice;//referente ao CifrasQueue::acordes
  public int $key;//chave que identifica o caractere.
  public Acorde $acorde;
  public string $caractere;

  public function __construct(int $indice, Acorde $acorde, int $key)
  {
    $this->indice = $indice;
    $this->key = $key;
    $this->acorde = $acorde;
    $this-> caractere = $this->acorde->cifraOriginal->sinal[$key];
  }

  abstract public function analisar();
}