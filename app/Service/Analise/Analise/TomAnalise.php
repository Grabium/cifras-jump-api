<?php

namespace App\Service\Analise\Analise;

class TomAnalise extends AnaliseAbstract
{
    private string $comandoParaIterador = '';
    private string $tom = '';
    private bool $seEnarmonico;

    public function analisar(): int | string
    {
        if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

        $this->setTom();

        $nameFunction = ($this->seInversao()) ? 'tratarInversao' : 'tratarFundamental';
        $this->$nameFunction();


        //$this->flag->eventoModular->abrir();
        return $this->comandoParaIterador;
    }

    private function setTom(): void
    {
        $this->tom = $this->sinal->getCurrent();
        $regex = '[#b]';

        if (preg_match('/' . $regex . '/', $this->sinal->getNext())) {
            $this->tom .= $this->sinal->getNext();
            $this->comandoParaIterador = 2;
            $this->seEnarmonico = true;
        } else {
            $this->comandoParaIterador = 'CHAMAR_PROXIMO_CARACTERE';
            $this->seEnarmonico = false;
        }
    }

    private function seInversao(): bool
    {
        return ($this->sinal->getPosition() != 0);
    }

    private function tratarFundamental(): void
    {
        $this->setEnarmonia('enarmoniaFundamental');
        $this->setCifra('fundamental');
    }

    private function tratarInversao(): void
    {
        if (!$this->flag->barra->status()) {
            $this->comandoParaIterador = 'INSERIR_EM_REPROVADO';
            return;
        }

        $this->setEnarmonia('enarmoniaInversao');
        $this->setCifra('inversao');
        $this->flag->eventoModular->abrir();
        $this->flag->inversaoConfirmada->abrir();
    }

    private function setEnarmonia(string $atributoDoAcordeParaAlterar): void
    {
        $enarmonia = ($this->seEnarmonico) ? $this->tom[1] : 'natural';
        $this->acorde->$atributoDoAcordeParaAlterar->set($enarmonia);
    }

    private function setCifra(string $atributoDoAcordeParaAlterar): void
    {
        $this->acorde->cifraOriginal->$atributoDoAcordeParaAlterar->set($this->tom);
    }
}
