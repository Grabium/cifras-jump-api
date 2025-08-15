<?php
namespace App\Service\Entidade\Acorde;

use App\Service\Entidade\Acorde\Composite\EnarmoniaComposite;
use App\Service\Entidade\Acorde\Composite\TercaComposite;
use App\Service\Entidade\Acorde\Composite\IntervaloComposite;
use App\Service\Entidade\Acorde\Cifra\Cifra;
use App\Service\Entidade\Acorde\Composite\QuintaComposite;
use App\Service\Entidade\Acorde\Composite\SetimaComposite;

class Acorde
{
    
    public     Cifra $cifraOriginal;
    public     Cifra $cifraFinal;
    public EnarmoniaComposite $enarmoniaFundamental;
    public EnarmoniaComposite $enarmoniaInversao;
    public     TercaComposite $terca;
    public    QuintaComposite $quinta;
    public    SetimaComposite $setima;
    public IntervaloComposite $intervalo;
    

    public function __construct(Cifra $cifra)
    {
        $this->cifraOriginal = $cifra;
        //$this->cifraFinal = new Cifra('');//apenas na fase de conversão.
        $this->enarmoniaFundamental = new EnarmoniaComposite();
        $this->enarmoniaInversao = new EnarmoniaComposite();
        $this->terca = new TercaComposite();
        $this->quinta = new QuintaComposite();
        $this->setima = new SetimaComposite();
        $this->intervalo = new IntervaloComposite();
    }

    public function get()
    {
        return $this->cifraOriginal->sinal;
    }
}
