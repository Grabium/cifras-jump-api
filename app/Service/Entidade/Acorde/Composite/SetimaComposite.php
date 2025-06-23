<?php

namespace App\Service\Entidade\Acorde\Composite;

class SetimaComposite extends Composite
{
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^(diminuta|menor|maior|NaoTestado)$';

        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Sinal de Sétima inválido: '.$key.'.');
        }
    }
}
