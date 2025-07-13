<?php

namespace App\Service\Analise\Matched;

use App\Service\Entidade\Acorde\Acorde;

abstract class Matched
{
    public int $key;//chave que identifica o caractere.
    public Acorde $acorde;
    public string $caractere;

    public function __construct(Acorde $acorde, int $key)
    {
        $this->key = $key;
        $this->acorde = $acorde;
        $this->caractere = $this->acorde->cifraOriginal->sinal[$key];
    }

    abstract public function handle(mixed $valor);
}
