<?php

namespace App\Entidade\Acorde\Composite;

class Terca extends AcordeComposicao
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
