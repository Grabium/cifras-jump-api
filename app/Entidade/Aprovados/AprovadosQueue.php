<?php

namespace App\Entidade\Aprovados;

class AprovadosQueue
{
    static public array $cifrasArpovadas = [];

    static public function getSinais()
    {
        $sinais = [];
        foreach(self::$cifrasArpovadas as $key => $acorde){
            $sinais[$key] = $acorde->get();
        }

        return $sinais;
    }
}
