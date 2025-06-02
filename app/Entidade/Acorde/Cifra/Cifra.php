<?php
namespace App\Entidade\Acorde\Cifra;

use App\Entidade\Acorde\Composite\Tom;

class Cifra
{
    public string $sinal;
    public Tom $fundamental;
    public Tom $inversao;

    public function __construct(string $sinal)
    {
        $this->sinal  = $sinal;
        $this->fundamental = new Tom();
        $this->inversao = new Tom();
    }

}
