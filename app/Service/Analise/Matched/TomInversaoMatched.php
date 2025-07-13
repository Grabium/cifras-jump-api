<?php
namespace App\Service\Analise\Matched;

class TomInversaoMatched extends Matched
{
    public function handle(mixed $valor)
    {
        $this->acorde->cifraOriginal->inversao->set($valor);
    }


}
