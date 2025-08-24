<?php

namespace App\Service\Analise\Analise\Traits;

use App\Service\Analise\Wrappers\Wrapper;

trait InversaoConfirmadaAnalise
{
    public function verificarInversaoConfirmada(Wrapper $wrapper, string $nomeDaClasseDeAnalise): string
    {
        $this->inserirDependencias($wrapper);

        $gatilhoReprovado = (!in_array($nomeDaClasseDeAnalise, $this->getGatilhosPermitidos()));

        return ($this->flag->inversaoConfirmada->status() && $gatilhoReprovado) ? $this->reprovado : $this->proximo ;
    }

    //simulando um __construct(Wrapper $wrapper)
    private function inserirDependencias(Wrapper $wrapper)
    {
        $this->acorde = $wrapper->getAcorde();
        $this->flag = $wrapper->getFlag();
        $this->sinal = $wrapper->getIterador();
        $this->wrapperMemento = $wrapper;
        $this->proximo = 'CHAMAR_PROXIMO_CARACTERE';
        $this->reprovado = 'INSERIR_EM_REPROVADO';
    }

    private function getGatilhosPermitidos(): array
    {
        return [
            'App\\Service\\Analise\\Analise\\SpaceAnalise',
            'App\\Service\\Analise\\Analise\\FechaParentesisAnalise',
        ];
    }
    
}
