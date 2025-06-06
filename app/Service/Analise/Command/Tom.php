<?php
namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\TomFundamental;

class Tom extends Command
{
    public function analisar()
    {
        if($this->key != 0){
            //processar inversao
        }

        //match na classe TomFundamental
        $this->acorde->cifraOriginal->fundamental->set($this->caractere);
        (new TomFundamental($this->indice, $this->acorde, $this->key))->handle('');
    }
}
