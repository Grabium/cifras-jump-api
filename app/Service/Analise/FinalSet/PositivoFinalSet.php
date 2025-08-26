<?php

namespace App\Service\Analise\FinalSet;

use App\Service\Entidade\Acorde\Acorde;

class PositivoFinalSet extends FinalSet
{
    public function deduce(Acorde $acorde)
    {

        if($acorde->enarmoniaFundamental->get() == 'NaoTestado'){
            $acorde->enarmoniaFundamental->set('natural');
        }

        if($acorde->cifraOriginal->inversao->get() == 'NaoTestado'){
            $acorde->cifraOriginal->inversao->set('fundamental');
        }

        if($acorde->terca->get() == 'NaoTestado'){
            $acorde->terca->set('maior');
        }

        if($acorde->quinta->get() == 'NaoTestado'){
            $acorde->quinta->set('justa');
        }

        if($acorde->setima->get() == 'NaoTestado'){
            unset($acorde->setima);
        }

        if($acorde->intervalo->getString() == 'NaoTestado'){
            unset($acorde->intervalo);
        }

        echo '<h2>[Resultado] "'.$acorde->cifraOriginal->sinal.'" foi aprovado!.</h2>'.PHP_EOL;
    }
}
