<?php

namespace App\Entidade\Acorde\Composite;

class IntervaloComposto extends Intervalo
{
    /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^[#b]?(1[0123467]|9)';

        if(!preg_match('/'.$regex.'/', $key) && $key != 'NaoTestado'){
            throw new \TypeError('Intervalo composto inválido: '.$key.'.');
        }
    }
}
