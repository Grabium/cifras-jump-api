<?php

namespace App\Service\Analise\Analise;

class BarraAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        $acaoDoIterador = $this->verificarCiclosEmAberto();

        //encerra qualquer ciclo de eventos dentro da barra independente da $acaoDoIterador
        if($this->flag->eventoModular->status()){
            $this->flag->fecharTodasAsFlags();
        }

        $this->flag->barra->abrir();

        return $acaoDoIterador;
    }

    private function verificarCiclosEmAberto(): string
    {
        $ciclos = [
            'barrasDuplicadas',
            'analiseDeDezenaEmAberto'
        ];

        foreach($ciclos as $ciclo){
            $acaoDoIterador = $this->$ciclo();
            if($acaoDoIterador === 'INSERIR_EM_REPROVADO'){
                break;
            }
        }

        return $acaoDoIterador;
    }

    private function barrasDuplicadas(): string
    {
        $haBarra = $this->flag->barra->status();
        $semEvento = ($this->flag->eventoModular->status() == false) ? true : false;
        return ($haBarra && $semEvento) ? 'INSERIR_EM_REPROVADO' : 'CHAMAR_PROXIMO_CARACTERE' ;
    }

    private function analiseDeDezenaEmAberto(): string
    {
        $intervaloComDezena = $this->flag->intervaloComDezena->status();
        $segundoAgarismoNaoEncontrado = (!$this->flag->segundoAgarismo->status());
        return ($intervaloComDezena && $segundoAgarismoNaoEncontrado) ? 'INSERIR_EM_REPROVADO' : 'CHAMAR_PROXIMO_CARACTERE' ;
    }
}

