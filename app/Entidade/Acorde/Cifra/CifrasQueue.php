<?php

namespace App\Entidade\Acorde\Cifra;

use App\Entidade\Acorde\Acorde;

class CifrasQueue
{
    static public array $acordes;

    static public function setAcordes(array $matches)
    {
        foreach($matches as $match){
            $cifra = new Cifra($match[0]);
            self::$acordes[$match[1]] = new Acorde($cifra);
        }
    }

    static public function getAcordes(): array
    {
        return self::$acordes;
    }
}
