<?php
namespace App\Entidade\Acorde;

use App\Entidade\Acorde\Composite\Enarmonia;
use App\Entidade\Acorde\Composite\Diminuto;
use App\Entidade\Acorde\Composite\Terca;
use App\Entidade\Acorde\Composite\Intervalo;
use App\Entidade\Acorde\Cifra\Cifra;

class Acorde
{
    
    public     Cifra $cifraOriginal;
    public     Cifra $cifraFinal;
    public Enarmonia $enarmonia;
    public     Terca $terca;
    public  Diminuto $diminuto;
    public Intervalo $intervalo;

    //public objeto $aumentado       
    //public objeto $intervNumericos 


    public function __construct(Cifra $cifra)
    {
        $this->cifraOriginal = $cifra;
        $this->enarmonia = new Enarmonia();
        $this->terca = new Terca();
        $this->diminuto = new Diminuto();
        $this->intervalo = new Intervalo();
    }

    public function get(): string
    {
        return $this->cifraOriginal->sinal;
    }
    
}
