<?php

namespace App\Service\Analise\Analise;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Analise\Wrappers\Flag;
use App\Service\Analise\Wrappers\IteradorSinal;
use App\Service\Analise\Wrappers\Wrapper;

abstract class AnaliseAbstract
{
  protected Acorde $acorde;
  protected Flag $flag;
  protected IteradorSinal $sinal;
  protected Wrapper $wrapperMemento;

  public function __construct(Wrapper $wrapper)
  {
    $this->acorde = $wrapper->getAcorde();
    $this->flag = $wrapper->getFlag();
    $this->sinal = $wrapper->getIterador();
    $this->wrapperMemento = $wrapper; //
  }

  /*****
 * @param void
 * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
 * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
 */
  abstract public function analisar(): int | string;
}