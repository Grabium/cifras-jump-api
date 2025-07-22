<?php

namespace App\Service\Analise\Analise;

class SpaceAnalise extends AnaliseAbstract
{
   /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        $barra = $this->flag->barra->status();
        $parentesis = $this->flag->parentesis->status();
        $composto = $this->flag->possivelIntervaloComposto->status();

        if($barra||$parentesis||$composto){
            return 'INSERIR_EM_REPROVADO';
        }
        
        return 'INSERIR_EM_APROVADO';
    }
}
