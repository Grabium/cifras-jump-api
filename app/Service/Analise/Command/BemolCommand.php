<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TomFundamentalMatched;
use App\Service\Analise\Matched\EnarmoniaMatched;

class BemolCommand extends Command
{
    /*****
     * @param void
     * @return string - 'INSERIR_EM_NEGATIVO', 'INSERIR_EM_POSITIVO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
     * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
     */
    public function analisar(): int | string
    {
        if($this->keyChar != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo em BemolCommand'.PHP_EOL;
        }

        (new EnarmoniaMatched($this->acorde, $this->keyChar))->handle($this->caractere);
        (new TomFundamentalMatched($this->acorde, $this->keyChar))->handle('');

        return 'CHAMAR_PROXIMO_CARACTERE';
    }
}
