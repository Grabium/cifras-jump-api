<?php

namespace App\Service\Analise\Analise;

class SpaceAnalise extends Analise
{
   /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        if($this->flag->barra->status()||$this->flag->parentesis->status()||$this->flag->possivelIntervaloComposto->status()){
            return 'INSERIR_EM_REPROVADO';
        }
        
        return 'INSERIR_EM_APROVADO';
    }
}
