<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\Analise\Traits\CiclosAnalise;

class SpaceAnalise extends AnaliseAbstract
{

    use CiclosAnalise;
   /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $acaoDoIterador = $this->verificarCiclosEmAberto($this->wrapperMemento);
 
        $this->flag->fecharTodasAsFlags(); //Não surte efeito prático. Apenas melhora a depuração.

        return ($acaoDoIterador === 'CHAMAR_PROXIMO_CARACTERE') ? 'INSERIR_EM_APROVADO' : $acaoDoIterador;
    }
}
