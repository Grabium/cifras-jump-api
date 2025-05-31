<?php

namespace App\Entidade\Acorde\Composite;

class Enarmonia implements AcordeComposicaoInterface
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
        $this->sinal = $key;
    }
  
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        if($key !== '#' && $key !== 'b' && $key != 'NaoTestado'){
            throw new \TypeError('Enarmonia apenas aceita [#] ou [b] como valor.');
        }
    }
}
