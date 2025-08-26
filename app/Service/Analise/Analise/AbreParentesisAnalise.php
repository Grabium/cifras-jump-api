<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\Analise\Traits\CiclosAnalise;

class AbreParentesisAnalise extends AnaliseAbstract
{
    
    use CiclosAnalise;

    public function analisar(): int | string
    {        
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $acaoDoIterador = $this->verificarCiclosEmAberto($this->wrapperMemento);

        //encerra qualquer ciclo de eventos que ocorria antes de abre-parêntesis independente da $acaoDoIterador
        if($this->flag->eventoModular->status()){
            $this->flag->fecharTodasAsFlags();
        }

        $this->flag->parentesis->abrir();
        
        return $acaoDoIterador;
    }
}