<?php
namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TomFundamentalMatched;

class TomCommand extends Command
{
    /*****
   * @param void
   * @return bool - true (chama o próximo acode). false (continua analisando o acorde).
   ******/
    public function analisar(): bool
    {
        if($this->key != 0){
            //processar inversao
            //analisar se procede uma barra
            echo 'chamar um negativo aqui por enquanto.'.PHP_EOL;
        }

        //match na classe TomFundamental
        $this->acorde->cifraOriginal->fundamental->set($this->caractere);
        (new TomFundamentalMatched($this->indice, $this->acorde, $this->key))->handle('');

        return false;
    }

}
