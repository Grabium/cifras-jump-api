<?php

namespace App\Service\Analise\Matcheds;

use App\Entidade\Aprovados\AprovadosQueue;

class Positivo extends Matched
{
    public function handle(string $caractere = '')
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
