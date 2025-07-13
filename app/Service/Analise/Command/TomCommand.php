<?php
namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TomFundamentalMatched;

class TomCommand extends Command
{
    /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        if($this->keyChar != 0){
            //processar inversao
            echo 'chamar um negativo aqui por enquanto.'.PHP_EOL;
        }

        //match na classe TomFundamental
        $this->acorde->cifraOriginal->fundamental->set($this->caractere);
        (new TomFundamentalMatched($this->acorde, $this->keyChar))->handle('');

        return 'CHAMAR_PROXIMO_CARACTERE';
    }

}
