<?php
namespace App\Service\Analise\Command;

class Tom extends Command
{
    public function analisar()
    {
        if($this->key != 0){
            //processar inversao
        }

        //match na classe TomFundamental
        $this->acorde->cifraOriginal->fundamental->set($this->caractere);
    }
}
