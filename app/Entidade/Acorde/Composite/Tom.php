<?php

namespace App\Entidade\Acorde\Composite;

class Tom
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
        $regex = '^[ABCDEFG][#b]?';

        if(!preg_match('/'.$regex.'/', $key, $tom) && $key != 'NaoTestado'){
            throw new \TypeError('Tonalidade inválida para o acorde: '.$key.'.');
        }
        var_dump($tom[0]);

        //$this->sinal = $tom[0];
    }
}