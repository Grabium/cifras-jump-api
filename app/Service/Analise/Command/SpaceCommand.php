<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\FinalSet\PositivoFinalSet;

class SpaceCommand extends Command
{
    /*****
    * @param void
    * @return string - CHAMAR_PROXIMO_ACORDE ou CHAMAR_PROXIMO_CARACTERE, que são ações para o iterador de sinal (Analise).
    * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
    */
    public function analisar(): int | string
    {
        return 'INSERIR_EM_APROVADO';
    }
}
