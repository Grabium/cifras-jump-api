<?php

namespace App\Service\Analise\Analise;

use App\Service\Detail\RejectDetail;

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
        if (!$this->flag->barra->status()||$this->flag->eventoModular->status()) {
            RejectDetail::log('012', __METHOD__, __LINE__, $this->sinal->getFullString());
            $this->comandoParaIterador = 'INSERIR_EM_REPROVADO';
            return;
        }

        $this->setEnarmonia('EnarmoniaInversao');
        $this->setCifra('Inversao');
        $this->flag->eventoModular->abrir();
        $this->flag->inversaoConfirmada->abrir();
    }

    private function setEnarmonia(string $atributoDoAcordeParaAlterar): void
    {
        $enarmonia = ($this->seEnarmonico) ? $this->tom[1] : 'natural';
        $atributoDoAcordeParaAlterar = 'set'.$atributoDoAcordeParaAlterar;
        $this->acorde->$atributoDoAcordeParaAlterar($enarmonia);
    }

    private function setCifra(string $atributoDoAcordeParaAlterar): void
    {
        $atributoDoAcordeParaAlterar = 'set'.$atributoDoAcordeParaAlterar;
        $this->acorde->$atributoDoAcordeParaAlterar($this->tom);
    }
}
