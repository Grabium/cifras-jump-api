<?php

namespace App\Service\Analise\Command;

class Bemol extends Command
{
    public function analisar()
    {
        if($this->key != 1){
            //processar intervalo
            echo 'Enttrou no if de intervalo'.PHP_EOL;
        }

        //match na classe TomFundamental
        $this->acorde->enarmonia->set($this->caractere);
        $fundamental = $this->acorde->cifraOriginal->fundamental->get();
        $this->acorde->cifraOriginal->fundamental->set($fundamental.$this->caractere);
    }
}
