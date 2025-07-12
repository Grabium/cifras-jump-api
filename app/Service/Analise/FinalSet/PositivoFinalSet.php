<?php

namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;

class PositivoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {
        if($acorde->enarmonia->get() == 'NaoTestado'){
            $acorde->enarmonia->set('natural');
        }

        if($acorde->terca->get() == 'NaoTestado'){
            $acorde->terca->set('maior');
        }

        if($acorde->quinta->get() == 'NaoTestado'){
            $acorde->quinta->set('justa');
        }
    }
}
