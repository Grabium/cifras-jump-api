<?php

namespace App\Service\Analise\Analise;

class BarraAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        if($this->flag->barra->status()){
            return 'INSERIR_EM_REPROVADO';
        }

        $this->flag->barra->abrir();

        return 'CHAMAR_PROXIMO_CARACTERE';
    }
}

