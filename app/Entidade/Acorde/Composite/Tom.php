<?php

namespace App\Entidade\Acorde\Composite;

class Tom extends AcordeComposicao
{
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^([ABCDEFG][#b]?|NaoTestado)$';

        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Tonalidade inválida para o acorde: '.$key.'.');
        }
    }
}