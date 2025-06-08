<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TercaMatched;
use App\Service\Analise\Matched\NegativoMatched;
use App\Service\Analise\Matched\EnarmoniaMatched;

class MenorCommand extends Command
{
    /*****
   * @param void
   * @return bool - true (chama o próximo acode). false (continua analisando o acorde).
   ******/
    public function analisar(): bool
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

        (new TercaMatched($this->indice, $this->acorde, $this->key))->handle('menor');

        return false;
    }

    private function negar()
    {
        (new NegativoMatched($this->indice, $this->acorde, $this->key))->handle('');
    }

    private function falharEmKey1($enarmonia): bool
    {
        if($enarmonia != 'NaoTestado'){
            $this->negar();
            return true;
        }elseif($enarmonia == 'NaoTestado'){
            (new EnarmoniaMatched($this->indice, $this->acorde, $this->key))->handle('natural');
            
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