<?php

namespace App\Service\Analise\Analise\Traits;

use App\Service\Analise\Wrappers\Wrapper;
use App\Service\Detail\RejectDetail;

trait InversaoConfirmadaAnalise
{

    const   PROXIMO = 'CHAMAR_PROXIMO_CARACTERE';
    const REPROVADO = 'INSERIR_EM_REPROVADO';

    public function verificarInversaoConfirmada(Wrapper $wrapper, string $nomeDaClasseDeAnalise): string
    {
        $this->inserirDependencias($wrapper);

        $gatilhoReprovado = (!in_array($nomeDaClasseDeAnalise, $this->getGatilhosPermitidos()));

        if($this->flag->inversaoConfirmada->status() && $gatilhoReprovado){
            RejectDetail::log('001', __METHOD__, __LINE__, $this->acode->get());
            return self::REPROVADO;
        }

        return self::PROXIMO;
    }

    //simulando um __construct(Wrapper $wrapper)
    private function inserirDependencias(Wrapper $wrapper)
    {
        $this->acorde = $wrapper->getAcorde();
        $this->flag = $wrapper->getFlag();
        $this->sinal = $wrapper->getIterador();
        $this->wrapperMemento = $wrapper;
    }

    private function getGatilhosPermitidos(): array
    {
        return [
            'App\\Service\\Analise\\Analise\\SpaceAnalise',
            'App\\Service\\Analise\\Analise\\FechaParentesisAnalise',
        ];
    }
    
}
