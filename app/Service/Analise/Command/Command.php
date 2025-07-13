<?php

namespace App\Service\Analise\Command;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Analise\Flag\FlagAnalise;

abstract class Command
{
  public int $keyChar;
  public Acorde $acorde;
  public string $caractere;
  public FlagAnalise $flag;

  public function __construct(Acorde $acorde, int $keyChar, FlagAnalise $flag)
  {
    $this->acorde = $acorde;
    $this->keyChar = $keyChar;
    $this->caractere = $this->acorde->cifraOriginal->sinal[$keyChar];
    $this->flag = $flag;
  }

  /*****
 * @param void
 * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
 * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
 */
  abstract public function analisar(): int | string;
}