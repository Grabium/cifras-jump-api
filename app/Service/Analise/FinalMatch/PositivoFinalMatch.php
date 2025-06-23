<?php

namespace App\Service\Analise\FinalMatch;

use App\Service\Entidade\Aprovados\AprovadosQueue;

class PositivoFinalMatch extends FinalMatch
{
    public function deduce()
    {
        $this->configurarPadroes();
        AprovadosQueue::$cifrasArpovadas[$this->indice] = $this->acorde;
    }

    private function configurarPadroes()
    {
        if($this->acorde->terca->get() == 'NaoTestado'){
            $this->acorde->terca->set('maior');
        }

        if($this->acorde->quinta->get() == 'NaoTestado'){
            $this->acorde->quinta->set('justa');
        }
    }
}
