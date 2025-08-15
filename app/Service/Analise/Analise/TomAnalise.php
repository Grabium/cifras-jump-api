<?php

namespace App\Service\Analise\Analise;

class TomAnalise extends AnaliseAbstract
{
    private string $comandoParaIterador = '';
    private string $tom = '';
    private bool $seEnarmonico;

    public function analisar(): int | string
    {
        $this->setTom();

        $nameFunction = ($this->seInversao()) ? 'tratarInversao' : 'tratarFundamental';
        $this->$nameFunction();

        //se inversao
        /*if ($this->sinal->getPosition() != 0) {

            if (!$this->flag->barra->status() || $this->flag->eventoModular->status()) {
                return 'INSERIR_EM_REPROVADO';
            }

            $this->flag->barra->fechar();
            $this->acorde->cifraOriginal->inversao->set($this->tom);
        } else {

            $this->acorde->cifraOriginal->fundamental->set($this->tom);

            if (strlen($this->tom) == 2) {
                $this->acorde->enarmoniaFundamental->set($this->tom[1]);
            }
        }*/

        $this->flag->eventoModular->abrir();
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
