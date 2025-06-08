<?php

namespace App\Entidade\Acorde\Composite;

abstract class Composite
{

    abstract protected function validate(mixed $key);

    private string $sinal;

    public function __construct()
    {
        $this->set();
    }

    public function set(mixed $key = 'NaoTestado')
    {
        $this->validate($key);
        $this->sinal = $key;
    }

    public function get(): mixed
    {
        return $this->sinal;
    }
}
