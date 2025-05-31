<?php

namespace App\Entidade\Acorde\Composite;

class Diminuto
{
    public string $sinal;

    /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function __construct(mixed $key = 'NaoTestado')
    {
        $this->validate($key);
        $this->sinal = $key['sinal'];
    }
  
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^(dim|°)';

        if(!preg_match('/'.$regex.'/', $key['sinal']) && $key != 'NaoTestado'){
            throw new \TypeError('Sinal de Diminuto inválido: '.$key['sinal'].'.');
        }
    }
}
