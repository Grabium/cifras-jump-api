<?php
namespace App\Service\Entidade\Acorde;


use App\Service\Entidade\Acorde\Composite\TercaComposite;
use App\Service\Entidade\Acorde\Composite\IntervaloComposite;
use App\Service\Entidade\Acorde\Cifra\Cifra;
use App\Service\Entidade\Acorde\Composite\QuintaComposite;
use App\Service\Entidade\Acorde\Composite\SetimaComposite;

class Acorde
{
    
    public              Cifra $cifraOriginal;
    public              Cifra $cifraFinal;
    public     TercaComposite $terca;
    public    QuintaComposite $quinta;
    public    SetimaComposite $setima;
    public IntervaloComposite $intervalo;
    

    public function __construct()
    {

        $this->cifraOriginal = new Cifra();
        $this->terca = new TercaComposite();
        $this->quinta = new QuintaComposite();
        $this->setima = new SetimaComposite();
        $this->intervalo = new IntervaloComposite();

        
    }

    public function set(string $sinal, bool $force = false):void
    {
        //try {

            $this->cifraOriginal->setSinal($sinal, $force);

        /*} catch (\Throwable $th) {

            $logDoSistema = $th->getMessage();
            $this->cifraOriginal->setSinal('INVALIDO');

        }*/
    }

    public function get():string
    {
        return $this->cifraOriginal->getSinal();
    }

    public function setFundamental(string $key):void
    {
        $this->cifraOriginal->setFundamental($key);
    }

    public function getFundamental():string
    {
        return $this->cifraOriginal->getFundamental();
    }

    public function setInversao(string $key):void
    {
        $this->cifraOriginal->setInversao($key);
    }

    public function getInversao():string
    {
        return $this->cifraOriginal->getInversao();
    }
    
    public function setEnarmoniaFundamental(string $key):void
    {
        $this->cifraOriginal->setEnarmoniaFundamental($key);
    }

    public function getEnarmoniaFundamental():string
    {
        return $this->cifraOriginal->getEnarmoniaFundamental();
    }

    public function setEnarmoniaInversao(string $key):void
    {
        $this->cifraOriginal->setEnarmoniaInversao($key);
    }

    public function getEnarmoniaInversao():string
    {
        return $this->cifraOriginal->getEnarmoniaInversao();
    }

    public function setTerca(string $key):void
    {
        $this->terca->set($key);
    }

    public function getTerca():string
    {
        return $this->terca->get();
    }

    public function setQuinta(string $key):void
    {
        $this->quinta->set($key);
    }

    public function getQuinta():string
    {
        return $this->quinta->get();
    }

    public function setSetima(string $key):void
    {
        $this->setima->set($key);
    }

    public function getSetima():string
    {
        return $this->setima->get();
    }

    public function setIntervalo(bool $cicloFinalizado = false, string $key = ''):void
    {
        $this->intervalo->setConcat($cicloFinalizado, $key);
    }

    public function getIntervalo(): string
    {
        return $this->intervalo->get();
    }

    public function hasDuplicityIntervals():bool
    {
        return $this->intervalo->hasDuplicityIntervals();
    }
}
