<?php

namespace App\Service\Entidade\Acorde\Composite;

class IntervaloSimplesComposite extends IntervaloComposite
{
    /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        $regex = '^([#b]?[234567]|NaoTestado)$';

        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Intervalo simples inválido: '.$key.'.');
        }
    }
}
