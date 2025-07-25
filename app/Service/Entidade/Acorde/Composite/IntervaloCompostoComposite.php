<?php

namespace App\Service\Entidade\Acorde\Composite;

class IntervaloCompostoComposite extends IntervaloComposite
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
