<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\Analise\Traits\CiclosAnalise;

class BarraAnalise extends AnaliseAbstract
{
    
    use CiclosAnalise;

    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $acaoDoIterador = $this->verificarCiclosEmAberto($this->wrapperMemento);

        //encerra qualquer ciclo de eventos dentro da barra independente da $acaoDoIterador
        if($this->flag->eventoModular->status()){
            $this->flag->fecharTodasAsFlags();
        }

        $this->flag->barra->abrir();

        return $acaoDoIterador;
    }
}

