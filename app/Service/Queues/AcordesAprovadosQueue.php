<?php

namespace App\Service\Queues;

use App\Service\Entidade\Acorde\Acorde;

class AcordesAprovadosQueue
{
    private array $cifrasArpovadas = [];
    private Acorde $acorde;

    public function getSinais()
    {
        $sinais = [];
        foreach($this->cifrasArpovadas as $key => $acorde){
            $sinais[$key] = $acorde['acorde']->get();
        }

        return $sinais;
    }

    public function get(null|int $indice=null)
    {
        return (is_int($indice)) ? $this->cifrasArpovadas[$indice] : $this->cifrasArpovadas;
    }

    public function inserir(int $indice, Acorde $acorde):void
    {
        $this->cifrasArpovadas[$indice] = ['acorde' => $acorde];
    }

}

