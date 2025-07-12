<?php

namespace App\Service\Queues;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Entidade\Acorde\Cifra\Cifra;

class AcordesAAnalisarQueue
{
    private array $acordes;

    public function enfileirarAcordes(string $texto):array
    {
        $regex = '[ABCDEFG][^\s]*[\t\n\s\r]';//tudo até o primeiro espaço.
        preg_match_all('/'.$regex.'/ ', $texto, $matches, PREG_OFFSET_CAPTURE);

        $this->acordes = [];

        foreach($matches[0] as $match){
            $cifra = new Cifra($match[0]);
            $this->acordes[$match[1]] = new Acorde($cifra);
        }

        //dd($this->acordes);
        return $this->acordes;
    }

    public function get(null|int $indice=null)
    {
        return (is_int($indice)) ? $this->acordes[$indice] : $this->acordes;
    }
}
