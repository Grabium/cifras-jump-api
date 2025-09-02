<?php
namespace App\Service\Analise\Analise;

use App\Service\Logs\LogReprovacao;

class DimAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $dimString = substr($this->sinal->getFullString(), $this->sinal->getPosition(), 3);

        if($dimString != 'dim'){
            LogReprovacao::log('010', __METHOD__, __LINE__);
            return 'INSERIR_EM_REPROVADO';
        }

        $this->acorde->terca->set('menor');
        $this->acorde->quinta->set('diminuta');
        
        return 3;
    }
}