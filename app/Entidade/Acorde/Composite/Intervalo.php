<?php

namespace App\Entidade\Acorde\Composite;

abstract class Intervalo extends AcordeComposicao
{
    abstract public function validate(mixed $key);

    public array $sinais;

    public function set(mixed $key = 'NaoTestado')
    {
        $this->validate($key);

        if($this->sinais[0] == 'NaoTestado'){
            $this->sinais[0] = $key;
        }else{
            $this->sinais[] = $key;
        }
    }

    public function get():mixed
    {
        return $this->sinais;
    }
}
