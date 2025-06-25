<?php

namespace App\Service\Analise\Command;

use App\Service\Entidade\Acorde\Acorde;

abstract class Command
{
  public int $indiceAcordesQueue;//referente ao CifrasQueue::acordes
  public int $keyChar;//chave que identifica o caractere.
  public Acorde $acorde;
  public string $caractere;

  public function __construct(int $indiceAcordesQueue, Acorde $acorde, int $keyChar)
  {
    $this->indiceAcordesQueue = $indiceAcordesQueue;
    $this->keyChar = $keyChar;
    $this->acorde = $acorde;
    $this->caractere = $this->acorde->cifraOriginal->sinal[$keyChar];
  }

  /*****
   * @param void
   * @return string - CHAMAR_PROXIMO_ACORDE ou CHAMAR_PROXIMO_CARACTERE, que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
  abstract public function analisar(): int | string;
}