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
        $acaoDoIterador = $this->inconsistencias();

        $this->flag->fecharTodasAsFlags(); //Não surte efeito prático. Apenas melhora a depuração.

        return $acaoDoIterador;
    }

    public function inconsistencias(): string
    {
        $barraInconsistente = ($this->flag->barra->status() && (!$this->flag->eventoModular->status()));
        $parentesisAberto = $this->flag->parentesis->status();

        return ($parentesisAberto||$barraInconsistente) ? 'INSERIR_EM_REPROVADO' : 'INSERIR_EM_APROVADO' ;
    }
}
