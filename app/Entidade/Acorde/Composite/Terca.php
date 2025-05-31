<?php

namespace App\Entidade\Acorde\Composite;

class Terca implements AcordeComposicaoInterface
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
        $regex = '(menor|maior|suspenso|NaoTestado)';
        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Terca aceita apenas [menor|maior|suspenso|NaoTestado] como valor.');
        }
    }
}
