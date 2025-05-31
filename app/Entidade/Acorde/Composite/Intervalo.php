<?php

namespace App\Entidade\Acorde\Composite;

abstract class Intervalo
{
    public array $sinais;

    /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function __construct(mixed $key = 'NaoTestado')
    {
        $this->validate($key);
        
        if($this->sinais[0] == 'NaoTestado'){
            $this->sinais[0] = $key;
        }else{
            $this->sinais[] = $key;
        }
    }

    abstract public function validate(mixed $key);
}
