<?php

namespace App\Service\Analise\Matched;

use App\Entidade\Aprovados\AprovadosQueue;

class PositivoMatched extends Matched
{
    public function handle(mixed $valor = '')
    {
        if($this->acorde->terca->get() == 'NaoTestado'){
            $this->acorde->terca->set('maior');
        }

        if($this->acorde->quinta->get() == 'NaoTestado'){
            $this->acorde->quinta->set('justa');
        }

        AprovadosQueue::$cifrasArpovadas[$this->indice] = $this->acorde;
    }
}
