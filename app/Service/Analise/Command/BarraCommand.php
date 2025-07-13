<?php

namespace App\Service\Analise\Command;

class BarraCommand extends Command
{
   /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        if($this->flag->barra->status()){
            return 'INSERIR_EM_NEGATIVO';
        }

        $this->flag->barra->abrir();

        return 'CHAMAR_PROXIMO_CARACTERE';
    }
}

