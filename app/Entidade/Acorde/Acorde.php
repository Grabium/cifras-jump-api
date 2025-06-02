<?php
namespace App\Entidade\Acorde;

use App\Entidade\Acorde\Composite\Enarmonia;
use App\Entidade\Acorde\Composite\Terca;
use App\Entidade\Acorde\Composite\Intervalo;
use App\Entidade\Acorde\Cifra\Cifra;
use App\Entidade\Acorde\Composite\Quinta;
use App\Entidade\Acorde\Composite\Setima;

class Acorde
{
    
    public     Cifra $cifraOriginal;
    public     Cifra $cifraFinal;
    public Enarmonia $enarmonia;
    public     Terca $terca;
    public    Quinta $quinta;
    public    Setima $setima;
    public Intervalo $intervalo;
    

    public function __construct(Cifra $cifra)
    {
        $this->cifraOriginal = $cifra;
        $this->enarmonia = new Enarmonia();
        $this->terca = new Terca();
        $this->quinta = new Quinta();
        $this->setima = new Setima();
    }

    public function get()
    {
        return $this->cifraOriginal->sinal;
    }
}
