<?php
namespace App\Service\Analise\Analise;

class DimAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        $dimString = substr($this->acorde->get(), $this->keyChar, 3);

        if(!$dimString == 'dim'){
            return 'INSERIR_EM_REPROVADO';
        }

        $this->acorde->terca->set('menor');
        $this->acorde->quinta->set('diminuta');
        
        return 2;
    }
}