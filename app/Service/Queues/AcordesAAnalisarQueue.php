<?php

namespace App\Service\Queues;

use App\Service\Entidade\Acorde\Acorde;

class AcordesAAnalisarQueue
{
    private array $acordes;

    public function enfileirarAcordes(string $texto):array
    {
        $regex = '[ABCDEFG][^\s]*[\t\n\s\r]';//tudo até o primeiro espaço.
        preg_match_all('/'.$regex.'/ ', $texto, $matches, PREG_OFFSET_CAPTURE);

        $this->acordes = [];

        foreach($matches[0] as $match){
            $acorde = new Acorde();
            $acorde->set($match[0]);
            $this->acordes[$match[1]] = $acorde;
        }

        return $this->acordes;
    }

    public function get(null|int $indice=null): Acorde|array
    {
        return (is_int($indice)) ? $this->acordes[$indice] : $this->acordes;
    }
}
