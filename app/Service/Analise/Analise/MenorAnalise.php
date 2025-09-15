<?php

namespace App\Service\Analise\Analise;

use App\Service\Detail\RejectDetail;

class MenorAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $enarmonia = $this->acorde->getEnarmoniaFundamental();
        $terca = $this->acorde->getTerca();

        if($terca != 'NaoTestado'){
            RejectDetail::log('013', __METHOD__, __LINE__, $this->sinal->getFullString());
            return 'INSERIR_EM_REPROVADO';
        }

        $falhar = 'falharEmKey'.$this->sinal->getPosition();
        $falhou = $this->$falhar($enarmonia);
        
        //dump($falhar, $falhou, $enarmonia, $terca);
        
        if($falhou){
            RejectDetail::log('014', __METHOD__, __LINE__, $this->sinal->getFullString());
            return 'INSERIR_EM_REPROVADO';
        }

        $this->acorde->setTerca('menor');

        return 'CHAMAR_PROXIMO_CARACTERE';
    }

    private function falharEmKey1($enarmonia): bool
    {
        if($enarmonia != 'natural'){
            return true;
        }        
        return false;        
    }

    private function falharEmKey2($enarmonia): bool
    {
        if(!in_array($enarmonia, ['b','#'])){
            return true;
        }
        return false;        
    }
}