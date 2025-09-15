<?php
namespace App\Service\Analise\Analise;

use App\Service\Detail\RejectDetail;

class DimAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $dimString = substr($this->sinal->getFullString(), $this->sinal->getPosition(), 3);

        if($dimString != 'dim'){
            RejectDetail::log('010', __METHOD__, __LINE__, $this->sinal->getFullString());
            return 'INSERIR_EM_REPROVADO';
        }

        $this->acorde->setTerca('menor');
        $this->acorde->setQuinta('diminuta');
        
        return 3;
    }
}