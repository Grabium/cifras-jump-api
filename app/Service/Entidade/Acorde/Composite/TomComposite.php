<?php

namespace App\Service\Entidade\Acorde\Composite;

class TomComposite extends Composite
{
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^([ABCDEFG][#b]?|NaoTestado|fundamental)$';

        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Tonalidade inválida para o acorde: '.$key.'.');
        }
    }
}