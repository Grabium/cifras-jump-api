<?php
namespace App\Entidade\Acorde;

use App\Entidade\Acorde\Composite\EnarmoniaComposite;
use App\Entidade\Acorde\Composite\TercaComposite;
use App\Entidade\Acorde\Composite\IntervaloComposite;
use App\Entidade\Acorde\Cifra\Cifra;
use App\Entidade\Acorde\Composite\QuintaComposite;
use App\Entidade\Acorde\Composite\SetimaComposite;

class Acorde
{
    
    public     Cifra $cifraOriginal;
    public     Cifra $cifraFinal;
    public EnarmoniaComposite $enarmonia;
    public     TercaComposite $terca;
    public    QuintaComposite $quinta;
    public    SetimaComposite $setima;
    public IntervaloComposite $intervalo;
    

    public function __construct(Cifra $cifra)
    {
        $this->cifraOriginal = $cifra;
        $this->enarmonia = new EnarmoniaComposite();
        $this->terca = new TercaComposite();
        $this->quinta = new QuintaComposite();
        $this->setima = new SetimaComposite();
    }

    public function get()
    {
        return $this->cifraOriginal->sinal;
    }
}
