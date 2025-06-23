<?php
namespace App\Service\Entidade\Acorde\Cifra;

use App\Service\Entidade\Acorde\Composite\TomComposite;

class Cifra
{
    public string $sinal;
    public TomComposite $fundamental;
    public TomComposite $inversao;

    public function __construct(string $sinal)
    {
        $this->sinal  = $sinal;
        $this->fundamental = new TomComposite();
        $this->inversao = new TomComposite();
    }

}
