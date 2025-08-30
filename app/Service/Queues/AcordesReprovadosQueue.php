<?php

namespace App\Service\Queues;

use App\Service\Entidade\Acorde\Acorde;

class AcordesReprovadosQueue
{
    private array $cifrasReprovadas = [];

    public function getSinais()
    {
        $sinais = [];
        foreach($this->cifrasReprovadas as $key => $acorde){
            $sinais[$key] = $acorde->get();
        }

        return $sinais;
    }

    public function get(null|int $indice=null)
    {
        return (is_int($indice)) ? $this->cifrasReprovadas[$indice] : $this->cifrasReprovadas;
    }

    public function inserir(int $indice, Acorde $acorde):void
    {
        $this->cifrasReprovadas[$indice] = ['acorde' => $acorde];
    }

    public function setLog(int $indice, string $log): void
    {
        $this->cifrasReprovadas[$indice] = [$this->cifrasReprovadas[$indice]['acorde'], 'log' => $log];
    }
}
