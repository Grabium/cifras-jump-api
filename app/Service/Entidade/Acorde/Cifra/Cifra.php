<?php
namespace App\Service\Entidade\Acorde\Cifra;

use App\Service\Entidade\Acorde\Composite\TomComposite;
use App\Service\Entidade\Acorde\Composite\EnarmoniaComposite;

class Cifra
{
    public             string $sinal;
    public       TomComposite $fundamental;
    public       TomComposite $inversao;
    public EnarmoniaComposite $enarmoniaFundamental;
    public EnarmoniaComposite $enarmoniaInversao;

    public function __construct()
    {
        $this->fundamental = new TomComposite();
        $this->inversao = new TomComposite();
        $this->enarmoniaFundamental = new EnarmoniaComposite();
        $this->enarmoniaInversao = new EnarmoniaComposite();
    }

    public function setSinal(string $sinal): void
    {
        if(($sinal[strlen($sinal)-1]) != ' '){
            throw new \TypeError("Cifra $sinal não possui SPACE CHARACTER no final. Gerará resultado inconsistente.");
        }
        $this->sinal = $sinal;
    }

    public function getSinal():string
    {
        return $this->sinal;
    }

    public function setFundamental(string $key):void
    {
        $this->fundamental->set($key);
    }

    public function getFundamental():string
    {
        return $this->fundamental->get();
    }

    public function setInversao(string $key):void
    {
        $this->inversao->set($key);
    }

    public function getInversao():string
    {
        return $this->inversao->get();
    }
    
    public function setEnarmoniaFundamental(string $key):void
    {
        $this->enarmoniaFundamental->set($key);
    }

    public function getEnarmoniaFundamental():string
    {
        return $this->enarmoniaFundamental->get();
    }

    public function setEnarmoniaInversao(string $key):void
    {
        $this->enarmoniaInversao->set($key);
    }

    public function getEnarmoniaInversao():string
    {
        return $this->enarmoniaInversao->get();
    }
    

}
