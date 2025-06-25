<?php
namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TomFundamentalMatched;

class TomCommand extends Command
{
    /*****
     * @param void
     * @return string - CHAMAR_PROXIMO_ACORDE ou CHAMAR_PROXIMO_CARACTERE, que são ações para o iterador de sinal (Analise).
     * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
     */
    public function analisar(): int | string
    {
        if($this->keyChar != 0){
            //processar inversao
            //analisar se procede uma barra
            echo 'chamar um negativo aqui por enquanto.'.PHP_EOL;
        }

        //match na classe TomFundamental
        $this->acorde->cifraOriginal->fundamental->set($this->caractere);
        (new TomFundamentalMatched($this->indiceAcordesQueue, $this->acorde, $this->keyChar))->handle('');

        return 'CHAMAR_PROXIMO_CARACTERE';
    }

}
