<?php

namespace App\Service\Analise\Matcheds;

class TomFundamental extends Matched
{
    public function handle()
    {
        $this->acorde->enarmonia->set($this->caractere);
        $fundamental = $this->acorde->cifraOriginal->fundamental->get();
        $this->acorde->cifraOriginal->fundamental->set($fundamental.$this->caractere);
    }
}
