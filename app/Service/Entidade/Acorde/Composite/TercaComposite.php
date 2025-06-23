<?php

namespace App\Service\Entidade\Acorde\Composite;

class TercaComposite extends Composite
{
    /**
     * 
     * @throws \TypeError
     * 
     *******/  
    protected function validate(mixed $key)
    {
        $regex = '(menor|maior|suspenso|NaoTestado)';

        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Terca aceita apenas [menor|maior|suspenso|NaoTestado] como valor.');
        }
    }
}
