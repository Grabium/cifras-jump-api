<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matcheds\Terca;
use App\Service\Analise\Matcheds\Negativo;
use App\Service\Analise\Matcheds\Enarmonia;

class Menor extends Command
{
    public function analisar()
    {
        //echo 'Inicializando Menor'.PHP_EOL;
        $enarmonia = $this->acorde->enarmonia->get();
        $terca = $this->acorde->terca->get();

        //echo 'Enarmonia: ', $enarmonia, ' - Terça: ', $terca, ' - Key: ', $this->key;

        if($terca != 'NaoTestado'){
            $this->negar();
            return true;
        }

        $falhar = 'falharEmKey'.$this->key;
        $falhou = $this->$falhar($enarmonia);
        
        if($falhou){
            return true;
        }

        (new Terca($this->indice, $this->acorde, $this->key))->handle('menor');
    }

    private function negar()
    {
        (new Negativo($this->indice, $this->acorde, $this->key))->handle('');
    }

    private function falharEmKey1($enarmonia): bool
    {
        if($enarmonia != 'NaoTestado'){
            $this->negar();
            return true;
        }elseif($enarmonia == 'NaoTestado'){
            (new Enarmonia($this->indice, $this->acorde, $this->key))->handle('natural');
            
        }

        return false;        
    }

    private function falharEmKey2($enarmonia): bool
    {
        if(!in_array($enarmonia, ['b','#'])){
            $this->negar();
            return true;
        }
        return false;        
    }
}