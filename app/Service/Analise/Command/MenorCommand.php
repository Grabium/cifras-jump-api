<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TercaMatched;
use App\Service\Analise\FinalMatch\NegativoFinalMatch;
use App\Service\Analise\Matched\EnarmoniaMatched;

class MenorCommand extends Command
{
    /*****
    * @param void
    * @return string - CHAMAR_PROXIMO_ACORDE ou CHAMAR_PROXIMO_CARACTERE, que são ações para o iterador de sinal (Analise).
    * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
    */
    public function analisar(): int | string
    {
        $enarmonia = $this->acorde->enarmonia->get();
        $terca = $this->acorde->terca->get();

        if($terca != 'NaoTestado'){
            //$this->negar();
            return 'INSERIR_EM_REPROVADO';
        }

        $falhar = 'falharEmKey'.$this->keyChar;
        $falhou = $this->$falhar($enarmonia);
        
        if($falhou){
            return 'INSERIR_EM_REPROVADO';
        }

        (new TercaMatched($this->indiceAcordesQueue, $this->acorde, $this->keyChar))->handle('menor');

        return 'CHAMAR_PROXIMO_CARACTERE';
    }
/*
    private function negar()
    {
        (new NegativoFinalMatch($this->indiceAcordesQueue, $this->acorde))->deduce();
    }
*/
    private function falharEmKey1($enarmonia): bool
    {
        if($enarmonia != 'NaoTestado'){
            //$this->negar();
            return true;
        }elseif($enarmonia == 'NaoTestado'){
            (new EnarmoniaMatched($this->indiceAcordesQueue, $this->acorde, $this->keyChar))->handle('natural');
            
        }

        return false;        
    }

    private function falharEmKey2($enarmonia): bool
    {
        if(!in_array($enarmonia, ['b','#'])){
            //$this->negar();
            return true;
        }
        return false;        
    }
}