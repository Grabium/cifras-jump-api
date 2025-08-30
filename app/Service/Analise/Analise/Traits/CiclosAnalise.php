<?php

namespace App\Service\Analise\Analise\Traits;

use App\Service\Analise\Wrappers\Flag\Flag;
use App\Service\Analise\Wrappers\Wrapper;
use App\Service\Logs\LogReprovacao;

trait CiclosAnalise
{  
    use IntervalosDeduceAnalise;

    public function verificarCiclosEmAberto(Wrapper $wrapper): string
    {
        
        $this->inserirDependencias($wrapper);

        foreach ($this->ciclosAVerificar as $ciclo) {
            $acaoDoIterador = $this->$ciclo();
            if ($acaoDoIterador == $this->reprovado) {
                break;
            }
        }

        $acaoDoIterador = $this->trataIntervalos($acaoDoIterador);

        return $acaoDoIterador;
    }

    private function trataIntervalos(string $acaoDoIterador): string
    {
        if(!($acaoDoIterador == 'CHAMAR_PROXIMO_CARACTERE' && $this->flag->possivelIntervalo->status())){
            return $acaoDoIterador;
        }

        $this->acorde->intervalo->setConcat(true, '');
        $this->deduceInterval($this->acorde);
        
        if($this->acorde->intervalo->hasDuplicityIntervals()){
            LogReprovacao::log('002', __METHOD__, __LINE__);
            return $this->reprovado;
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
        $caracteres = ["/" => 'barra',
                        "(" => 'abreParentesis',
                        ")" => 'fechaParentesis',
        ];//fora isso, pode chamar $this->__call();

        $caractere = $caracteres[$this->sinal->getCurrent()] ?? $this->sinal->getCurrent();

        return [
            $caractere.'Duplicado',
            'analiseDeDezenaEmAberto',
            'sustenidoBemolSemAlgarismo',
        ];
    }

    /***
    * CICLOS A SEREM ANALISADOS
    */

    public function __call(string $name, array $args = []): mixed
    {
        return $this->proximo;
    }


    private function abreParentesisDuplicado(): string
    {
        $sucedeUmaBarra = $this->verificaSeSucedeUmaBarra();
        $parentesisAberto = $this->flag->parentesis->status();
        $semEvento = $this->semEventosModulares();
        return (($parentesisAberto && $semEvento)||($sucedeUmaBarra)) ? $this->reprovado : $this->proximo;
    }

    private function fechaParentesisDuplicado(): string
    {
        $repetido = $this->sinal->matchPrev('^\)$');
        $semEvento = $this->semEventosModulares();
        return ($repetido || $semEvento) ? $this->reprovado : $this->proximo;
    }

    //Detecta duas barras em seguida.
    private function barraDuplicado(): string
    {
        $sucedeUmaBarra = $this->verificaSeSucedeUmaBarra();
        $semEvento = $this->semEventosModulares();
        return ($sucedeUmaBarra && $semEvento) ? $this->reprovado : $this->proximo;
    }

    private function verificaSeSucedeUmaBarra(): bool
    {
        return $this->sinal->matchPrev('^\/$');
    }

    private function semEventosModulares(): bool
    {
        return (!$this->flag->eventoModular->status());
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
