<?php

namespace App\Service\Analise\Analise\Traits;

use App\Service\Analise\Wrappers\Wrapper;

trait CiclosAnalise
{   
    public function verificarCiclosEmAberto(Wrapper $wrapper): string
    {
        
        $this->inserirDependencias($wrapper);

        foreach ($this->ciclosAVerificar as $ciclo) {
            $acaoDoIterador = $this->$ciclo();
            if ($acaoDoIterador == $this->reprovado) {
                break;
            }
        }

        if($acaoDoIterador == 'CHAMAR_PROXIMO_CARACTERE'){
            $this->acorde->intervalo->setConcat(true, '');
            $acaoDoIterador = $this->acorde->intervalo->hasDuplicityIntervals() ? $this->reprovado : $acaoDoIterador ;
        }

        return $acaoDoIterador;
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
        $this->ciclosAVerificar = $this->getCiclosAVerificar();
    }

    //Nome das funções que representam ciclos
    private function getCiclosAVerificar(): array
    {
        return [
            'barrasDuplicadas',
            'analiseDeDezenaEmAberto',
            'sustenidoBemolSemAlgarismo',
        ];
    }

    /***
    * CICLOS A SEREM ANALISADOS
    */
    
    
    //Detecta duas barras em seguida.
    private function barrasDuplicadas(): string
    {
        $haBarra = $this->flag->barra->status();
        $semEvento = ($this->flag->eventoModular->status() == false) ? true : false;
        return ($haBarra && $semEvento) ? $this->reprovado : $this->proximo;
    }

    //Detecta que um intervalo maior que 10 não teve seu segundo algarismo digitado. Apenas o "1".
    private function analiseDeDezenaEmAberto(): string
    {
        $intervaloComDezena = $this->flag->intervaloComDezena->status();
        $segundoAgarismoNaoEncontrado = (!$this->flag->segundoAgarismo->status());
        return ($intervaloComDezena && $segundoAgarismoNaoEncontrado) ? $this->reprovado : $this->proximo;
    }

    //Detecta que foi digitado "#" ou "b" mas o algarismo do intervalo não surgiu.
    private function sustenidoBemolSemAlgarismo(): string
    {
        return ($this->flag->aguardandoQualquerAlgarismo->status()) ? $this->reprovado : $this->proximo;
    }
}
