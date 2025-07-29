<?php
namespace App\Service\Analise\Wrappers;

use App\Service\Entidade\Acorde\Acorde;

class Wrapper
{
    private IteradorSinal $iterador;
    private Flag $flag;
    private Acorde $acorde;

    public function __construct(Acorde $acorde)
    {
        $this->acorde = $acorde;
        $this->iterador = new IteradorSinal($acorde->get());
        $this->flag = new Flag();
    }

    public function getIterador():IteradorSinal
    {
        return $this->iterador;
    }

    public function getFlag():Flag
    {
        return $this->flag->flagFactory();
    }

    public function getAcorde():Acorde
    {
        return $this->acorde;
    }
}
