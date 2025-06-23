<?php

namespace App\Service\Entidade\Acorde\Cifra;

use App\Service\Entidade\Acorde\Acorde;

class CifrasQueue
{
    public array $acordes;

    public function enfileirarAcordes(array $matches):array
    {
        foreach($matches as $match){
            $cifra = new Cifra($match[0]);
            $this->acordes[$match[1]] = new Acorde($cifra);
        }

        return $this->acordes;
    }
}
