<?php

namespace App\Service\Entidade\Acorde\Composite;

abstract class Composite
{

    abstract protected function validate(mixed $key);

    private string $sinal;

    public function __construct()
    {
        $this->set();
    }

    public function set(mixed $key = 'NaoTestado'): void
    {

        if (!$this->tryValidated($key)) {
            return;
        }

        $this->sinal = $key;
    }

    public function get(): mixed
    {
        return $this->sinal;
    }

    public function tryValidated($key): bool
    {
        try {
            
            $this->validate($key);

        } catch (\InvalidArgumentException $err) {
            echo $err->getMessage() . PHP_EOL;
            return false;
        }

        return true;
    }
}
