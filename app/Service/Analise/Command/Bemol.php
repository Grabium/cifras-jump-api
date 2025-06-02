<?php

namespace App\Service\Analise\Command;

class Bemol extends Command
{
    public function analisar()
    {
        if($this->key != 2){
            //processar intervalo
        }

        //match na classe TomFundamental
        $this->acorde->enarmonia->set($this->caractere);
        $fundamental = $this->acorde->cifraOriginal->fundamental->get();
        $this->acorde->cifraOriginal->fundamental->set($fundamental.$this->caractere);
    }
}
