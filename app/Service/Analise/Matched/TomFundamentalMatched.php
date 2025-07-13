<?php

namespace App\Service\Analise\Matched;

class TomFundamentalMatched extends Matched
{
    public function handle(mixed $valor)
    {
        /*if($this->key == 0){
            $this->acorde->cifraOriginal->fundamental->set($this->caractere);
            return;
        }*/

        $this->acorde->cifraOriginal->fundamental->set($valor);
    }
}
