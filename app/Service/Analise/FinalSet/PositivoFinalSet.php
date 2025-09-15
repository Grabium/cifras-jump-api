<?php

namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;

class PositivoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {

        if($acorde->getEnarmoniaFundamental() == 'NaoTestado'){
            $acorde->setEnarmoniaFundamental('natural');
        }

        if($acorde->getEnarmoniaInversao() == 'NaoTestado'){
            unset($acorde->enarmoniaInversao);
        }

        if($acorde->getInversao() == 'NaoTestado'){
            $acorde->setInversao('fundamental');
        }

        if($acorde->getTerca() == 'NaoTestado'){
            $acorde->setTerca('maior');
        }

        if($acorde->getQuinta() == 'NaoTestado'){
            $acorde->setQuinta('justa');
        }

        if($acorde->getSetima() == 'NaoTestado'){
            unset($acorde->setSetima);
        }

        if($acorde->getIntervalo() == 'NaoTestado'){
            unset($acorde->intervalo);
        }
    }
}
