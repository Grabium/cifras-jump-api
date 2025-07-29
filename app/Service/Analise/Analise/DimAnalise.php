<?php
namespace App\Service\Analise\Analise;

class DimAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        $dimString = substr($this->sinal->getFullString(), $this->sinal->getPosition(), 3);

        if($dimString != 'dim'){
            return 'INSERIR_EM_REPROVADO';
        }

        $this->acorde->terca->set('menor');
        $this->acorde->quinta->set('diminuta');
        
        return 3;
    }
}